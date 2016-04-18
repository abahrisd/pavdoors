<?php

    $output = array(
      'status' => 'success',
      'msg' => 'message',
      'data' => 'blaaaaaaaah',
      'lastpost' => FALSE,
    );

    $properties = $scriptProperties['data'];

    $modx->log(modX::LOG_LEVEL_ERROR,'Running processor: ajax.generic, scriptProperties = '. print_r($properties, TRUE));

    $limit  = $properties['limit'];
    $parents = $properties['parents'];
    $tpl    = $properties['tpl'];
    $offset = $properties['offset'];
    $depth = $properties['depth'];
    $sortby = $properties['sortby'];
    $debug = $properties['debug'];
    $showHidden = $properties['showHidden'];
    $hideContainers = $properties['hideContainers'];

    $modx->log(modX::LOG_LEVEL_ERROR, 'tpl = ' . $tpl);

    $posts = $modx->runSnippet('getPages', array(
//        'parents'       => $parents,
//        'depth'         => $depth,
        'limit'         => $limit,
        'offset'        => $offset,
        'includeTVs'    => '1',
        'processTVs'    => '1',
        'includeContent' => '1',
        'tpl'           => $tpl,
        'debug'         => $debug,
        'sortby'        => $sortby,
        'showHidden'    => $showHidden,
        'hideContainers'=> $hideContainers,
    ));

//   $output['posts'] = '<div class="post-group" style="display:none" >' . $posts . '</div>';

//   if(strlen($posts) == 0){
//      $output['lastpost'] = TRUE;
//   }

$output = $modx->toJSON($output);

return $output;