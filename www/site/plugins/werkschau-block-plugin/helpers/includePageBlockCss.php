<?php
function includePageBlockCss(){
    $page = page();
    $site = site();
    $cssPaths = array();
    $css = '';

    foreach ($page->content()->fields() as $field) {
        $arr = $field->split();

        foreach ($arr as $value){
            if($foundPage = $site->find($value)){
                if('block' == substr($foundPage->intendedTemplate(), 0, 5)){
                    $expectedPath = 'assets/css/blocks/' . $foundPage->intendedTemplate()->name() . '.css';
                    $asset = asset($expectedPath);

                    if(!in_array($expectedPath, $cssPaths)){
                        array_push($cssPaths, $expectedPath);
                        $css .= compress(file_get_contents(strval($asset->url())));
                    }
                }
            }
        }
    }
    return $css;
}

function compress($buffer) {
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}
