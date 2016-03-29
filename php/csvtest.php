<?php

    $uploadpath = $modx->config['base_path'] . 'assets/userfiles/'; // where to put uploaded file
    $filename = basename($_FILES['pricefile']['name']);

    function updatePrice($id, $value){
        $resource = $modx->getObject('modResource',array('id'=>$id));
        //$val = $resource->getTVValue('stat_1'); // берем значение ресурса
        $resource->setTVValue('price', $value); // изменяем резурс
        $resource->save(); // Фиксируем изменения
        $resource->remove(); // Удаляем ресурс
    }

    if (($handle = fopen($_FILES['pricefile']['tmp_name'], "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);

        if ($num != 3) {
         //echo "В каждой строке должно быть три поля (без заголовков): Наименование, id ресурса из админки сайта и цена";
         return "В каждой строке должно быть три поля (без заголовков): Наименование, id ресурса из админки сайта и цена";
        }

        //echo "<p> Обновляется $num товаров fields in line $row: <br /></p>\n";

        if (!is_numeric($data[1])) {
         //echo "Ошибка в строке $row - в первом поле (id) должно быть числовое значение";
         return "Ошибка в строке $row - в первом поле (id) должно быть числовое значение";
        }

        if (!is_numeric($data[2])) {
         //echo "Ошибка в строке $row - во втором поле (цена) должно быть числовое значение";
         return "Ошибка в строке $row - во втором поле (цена) должно быть числовое значение";
        }

        if (array_key_exists($data[1], $upd_arrray)){
         //echo "Ошибка в строке $row - идентификаторы товаров не могут повторятся. Указанный идентификатор используется в другом товаре.";
         return "Ошибка в строке $row - идентификаторы товаров не могут повторятся. Указанный идентификатор используется в другом товаре.";
        }

        $upd_arrray[$data[1]] = $data[2];
        $row++;
        }

        fclose($handle);

        foreach($upd_arrray as $key => $value) {
         updatePrice($key, $value);
        }

    } else {

     return "Файл с требуемым имененм отсутствует!";
    }



    function updatePrice($id, $value){
        $resource = $modx->getObject('modResource',array('id'=>$id));
        //$val = $resource->getTVValue('stat_1'); // берем значение ресурса
        $resource->setTVValue('price', $value); // изменяем резурс
        $resource->save(); // Фиксируем изменения
        $resource->remove(); // Удаляем ресурс
        return true;
    }

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


    return $AjaxForm->error('Ошибки в форме', array(
        'name' => $_FILES
    ));

    if (is_uploaded_file($_FILES['priceFile']['tmp_name'])) {

        return $AjaxForm->success(
            $_FILES['priceFile']['tmp_name'] . ' ' .
            $_FILES['priceFile']['name'] . ' ' .
            $_FILES['priceFile']['type'] . ' ' .
            $_FILES['priceFile']['size']
        );

    } else {

        return $AjaxForm->error('Ошибки в форме', array(
            'name' => 'Файл не передан'
        ));
    }

    return $AjaxForm->success($_POST['priceFile']);

    function updatePrice($id, $value){
        /*$resource = $modx->getObject('modResource',array('id'=>$id));
        //$val = $resource->getTVValue('stat_1'); // берем значение ресурса
        $resource->setTVValue('price', $value); // изменяем резурс
        $resource->save(); // Фиксируем изменения

        $resource->remove(); // Удаляем ресурс*/


        echo "Цена товара с id = $id была обновлена, значение = $value <br />";
    }

    $upd_arrray = [];

    $row = 1;
    if (($handle = fopen("test.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $num = count($data);

            if ($num != 3) {
                echo "В каждой строке должно быть три поля (без заголовков): Наименование, id ресурса из админки сайта и цена";
                return false;
            }

            //echo "<p> Обновляется $num товаров fields in line $row: <br /></p>\n";

            if (!is_numeric($data[1])) {
                echo "Ошибка в строке $row - в первом поле (id) должно быть числовое значение";
                return false;
            }

            if (!is_numeric($data[2])) {
                echo "Ошибка в строке $row - во втором поле (цена) должно быть числовое значение";
                return false;
            }

            if (array_key_exists($data[1], $upd_arrray)){
                echo "Ошибка в строке $row - идентификаторы товаров не могут повторятся. Указанный идентификатор используется в другом товаре.";
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

        echo "Файл с требуемым имененм отсутствует!";
    }




if (!empty($_FILES['priceFile'])) {
    return $AjaxForm->error('Ошибки в форме', array(
        'name' => $_FILES['priceFile']
    ));
} else {
    return $AjaxForm->error('Ошибки в форме', array(
            'name' => 'Пусто!'
        ));
}

?>