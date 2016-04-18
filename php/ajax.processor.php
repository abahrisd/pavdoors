<?php
//$modx->log(modX::LOG_LEVEL_ERROR,'Running processor: ajax.generic, snippet = '. print_r($_POST, TRUE));

$output = $modx->runSnippet('getPaging', array('data' => $_POST));

header('Content-type: application/json');

return $output;
?>