<?php
function includePageBlockJs(){
    $page = page();
    $site = site();
    $jsPaths = array();

    foreach ($page->content()->fields() as $field) {
        $arr = $field->split();

        foreach ($arr as $value){
            if($foundPage = $site->find($value)){
                if('block' == substr($foundPage->intendedTemplate(), 0, 5)){
                    $expectedPath = 'assets/js/blocks/' . $foundPage->intendedTemplate()->name() . '.js';
                    $asset = asset($expectedPath);

                    if(!in_array($expectedPath, $jsPaths)){
                        if($asset->exists()){
                            array_push($jsPaths, $expectedPath);
                        }
                    }
                }
            }
        }
    }
    return js($jsPaths, ['nonce' => kirby()->nonce()]);
}
