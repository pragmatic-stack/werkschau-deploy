<?php
return function ($page) {
    $displayTitle   = $page->displayTitle()->toBool();
    $structures     = $page->pageStructure()->toStructure();

    $sections = [];
    $pageContent = [];
    $mapBlocks = [];

    foreach ($structures as $structure){
        array_push($sections, $structure);
    }

    foreach ($sections as $section){

        if($section->asFullWidthSection()->toBool()){
            $containerClassList = ['container-fluid', 'ws-section--fullwidth'];
        } else {
            $containerClassList = ['container', 'ws-section'];
        }

        $containerPadding = [];

        if($paddingTop = $section->paddingTop()){
            array_push($containerPadding,'padding-top: ' . $paddingTop . 'px;');
        }

        if($paddingBottom = $section->paddingBottom()){
            array_push($containerPadding,'padding-bottom: ' . $paddingBottom . 'px;');
        }

        $containerAttributes = attr(['class' => $containerClassList, 'style' => $containerPadding]);

        $sectionArr = [
            'sectionConfig' => [
                'title'                 => $section->sectionTitle()->value(),
                'displayTitle'          => $section->displayTitle()->toBool(),
                'containerAttributes'   => $containerAttributes,
                'withBackground'        => $section->withBackground()->toBool()
            ]
        ];

        $sectionArr['blocks'] = [];

        $blocks = $section->sectionBlocks()->toStructure();

        foreach ($blocks as $block){
           // build config for snippet
            $options = array(
                'fullWidthContainer'    => $section->asFullWidthSection()->toBool(),
                'blockWidth'            => $block->blockWidth()->value(),
                'displayTitle'          => $block->displayTitle()->value(),
                'displayHeadline'       => $block->displayHeadline()->value(),
            );

            $sectionArr['blocks'][] = array('part' => $block->blocks()->toPage(), 'options' => $options);

            // check if its a map block
            if($block->blocks()->toPage()->intendedTemplate() == 'block-maps'){
                array_push($mapBlocks, $block->blocks()->toPage()->initMapJs());
            }
        }

        array_push($pageContent, $sectionArr);
    }

    return [
        'displayTitle'  => $displayTitle,
        'pageContent'   => $pageContent,
        'mapBlocksJs'   => sizeof($mapBlocks) > 0 ? $mapBlocks : null
    ];
};
