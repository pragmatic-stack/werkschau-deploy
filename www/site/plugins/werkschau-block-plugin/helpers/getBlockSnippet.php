<?php

use Kirby\Cms\Page;

function getBlockSnippet(Page $page, string $field, $options = null)
{
    if ($contentPage = fromContentToPage($page, $field)) {
        if ($options == null) {
            $config = ['part' => $contentPage];
        } else {
            $config = ['part' => $contentPage, 'options' => $options];
        }

        return snippet($contentPage->intendedTemplate(), $config, true);
    } else {
        return null;
    }
}
