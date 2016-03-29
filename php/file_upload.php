<?php

    function updatePrice($id, $value){
    var_dump('$id');
    var_dump($id);
        $resource = $modx->getObject('modResource',array('id'=>$id));
        //$val = $resource->getTVValue('stat_1'); // берем значение ресурса
        $resource->setTVValue('price', $value); // изменяем резурс
        $resource->save(); // Фиксируем изменения
        $resource->remove(); // Удаляем ресурс
        return true;
    }

    $upd_arrray = [];
    $row = 1;
    $uploadpath = $modx->config['base_path'] . 'assets/userfiles/'; // where to put uploaded file
    $filename = basename(date("Ymdgi").$_FILES['pricefile']['name']);

    if ($filename != '') {
        $myTarget = $uploadpath . $filename;

        if (move_uploaded_file($_FILES['pricefile']['tmp_name'], $myTarget)) {
            if (($handle = fopen($myTarget, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $num = count($data);

                    if ($num != 3) {
                        return false;
                    }

                    //echo "<p> Обновляется $num товаров fields in line $row: <br /></p>\n";

                    if (!is_numeric($data[1])) {
                        return false;
                    }

                    if (!is_numeric($data[2])) {
                        return false;
                    }

                    if (array_key_exists($data[1], $upd_arrray)){
                        return false;
                    }

                    $upd_arrray[$data[1]] = $data[2];
                    $row++;
                }

                fclose($handle);

                foreach($upd_arrray as $key => $value) {
                    updatePrice($key, $value);
                }

            } else {
                return false;
            }

            chmod($myTarget, 0644);
            return true;
        } else {
            // File not uploaded
            return false; // generate submission error
        }
    } else {
        return false; // if no file, don't generate error, just return blank
    }