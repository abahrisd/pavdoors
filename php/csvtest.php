<?php

    $uploadpath = $modx->config['base_path'] . 'assets/userfiles/'; // where to put uploaded file
    $filename = basename($_FILES['pricefile']['name']);

    function updatePrice($id, $value){
        $resource = $modx->getObject('modResource',array('id'=>$id));
        //$val = $resource->getTVValue('stat_1'); // ����� �������� �������
        $resource->setTVValue('price', $value); // �������� ������
        $resource->save(); // ��������� ���������
        $resource->remove(); // ������� ������
    }

    if (($handle = fopen($_FILES['pricefile']['tmp_name'], "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);

        if ($num != 3) {
         //echo "� ������ ������ ������ ���� ��� ���� (��� ����������): ������������, id ������� �� ������� ����� � ����";
         return "� ������ ������ ������ ���� ��� ���� (��� ����������): ������������, id ������� �� ������� ����� � ����";
        }

        //echo "<p> ����������� $num ������� fields in line $row: <br /></p>\n";

        if (!is_numeric($data[1])) {
         //echo "������ � ������ $row - � ������ ���� (id) ������ ���� �������� ��������";
         return "������ � ������ $row - � ������ ���� (id) ������ ���� �������� ��������";
        }

        if (!is_numeric($data[2])) {
         //echo "������ � ������ $row - �� ������ ���� (����) ������ ���� �������� ��������";
         return "������ � ������ $row - �� ������ ���� (����) ������ ���� �������� ��������";
        }

        if (array_key_exists($data[1], $upd_arrray)){
         //echo "������ � ������ $row - �������������� ������� �� ����� ����������. ��������� ������������� ������������ � ������ ������.";
         return "������ � ������ $row - �������������� ������� �� ����� ����������. ��������� ������������� ������������ � ������ ������.";
        }

        $upd_arrray[$data[1]] = $data[2];
        $row++;
        }

        fclose($handle);

        foreach($upd_arrray as $key => $value) {
         updatePrice($key, $value);
        }

    } else {

     return "���� � ��������� ������� �����������!";
    }



    function updatePrice($id, $value){
        $resource = $modx->getObject('modResource',array('id'=>$id));
        //$val = $resource->getTVValue('stat_1'); // ����� �������� �������
        $resource->setTVValue('price', $value); // �������� ������
        $resource->save(); // ��������� ���������
        $resource->remove(); // ������� ������
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

                    //echo "<p> ����������� $num ������� fields in line $row: <br /></p>\n";

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


    return $AjaxForm->error('������ � �����', array(
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

        return $AjaxForm->error('������ � �����', array(
            'name' => '���� �� �������'
        ));
    }

    return $AjaxForm->success($_POST['priceFile']);

    function updatePrice($id, $value){
        /*$resource = $modx->getObject('modResource',array('id'=>$id));
        //$val = $resource->getTVValue('stat_1'); // ����� �������� �������
        $resource->setTVValue('price', $value); // �������� ������
        $resource->save(); // ��������� ���������

        $resource->remove(); // ������� ������*/


        echo "���� ������ � id = $id ���� ���������, �������� = $value <br />";
    }

    $upd_arrray = [];

    $row = 1;
    if (($handle = fopen("test.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $num = count($data);

            if ($num != 3) {
                echo "� ������ ������ ������ ���� ��� ���� (��� ����������): ������������, id ������� �� ������� ����� � ����";
                return false;
            }

            //echo "<p> ����������� $num ������� fields in line $row: <br /></p>\n";

            if (!is_numeric($data[1])) {
                echo "������ � ������ $row - � ������ ���� (id) ������ ���� �������� ��������";
                return false;
            }

            if (!is_numeric($data[2])) {
                echo "������ � ������ $row - �� ������ ���� (����) ������ ���� �������� ��������";
                return false;
            }

            if (array_key_exists($data[1], $upd_arrray)){
                echo "������ � ������ $row - �������������� ������� �� ����� ����������. ��������� ������������� ������������ � ������ ������.";
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

        echo "���� � ��������� ������� �����������!";
    }




if (!empty($_FILES['priceFile'])) {
    return $AjaxForm->error('������ � �����', array(
        'name' => $_FILES['priceFile']
    ));
} else {
    return $AjaxForm->error('������ � �����', array(
            'name' => '�����!'
        ));
}

?>