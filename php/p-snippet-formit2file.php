<?php
$path; // Path from root that user specifies
$extensions; // allow file extensions

$ext_array = explode(',', $extensions);

// Create path
$basepath = $modx->config['base_path']; // Site root
$target_path = $basepath . $path; // root /assets/upload

//$target_path = '/home/emeraldfound/emeraldfoundation.ca/assets/uploads/';

// Get Filename and make sure its good.
$filename = basename( $_FILES['pricefile']['name'] );

// Get files extension
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if($filename != '')
{
    // Make filename a good unique filename.
    // Make lowercase
    $filename = mb_strtolower($filename);
    // Replace spaces with _
    $filename = str_replace(' ', '_', $filename);
    // Add timestamp
    $filename = date("Ymdgi") . $filename;

    // Set final path
    $target_path = $target_path . $filename;

    if(in_array($ext, $ext_array))
    {
        if(move_uploaded_file($_FILES['pricefile']['tmp_name'], $target_path))
        {
            // Upload successful
            //$hook->setValue('pricefile',$_FILES['pricefile']['name']);
            $hook->setValue('pricefile',$filename);
            return true;
        }
        else
        {
            // File not uploaded
            $errorMsg = 'File not uploaded.';
            $hook->addError('pricefile',$errorMsg);
            return false;
        }
    }
    else
    {
        // File type not allowed
        $errorMsg = 'File not allowed.';
        $hook->addError('pricefile',$errorMsg);
        return false;
    }
}
else
{
    $hook->setValue('pricefile','');
    return true;
}

return true;
?>