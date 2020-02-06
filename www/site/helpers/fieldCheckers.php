<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Cms\Field;

function fromContentWithValue(Field $field): ?Field{
    if($field->exists() && $field->isNotEmpty()) {
        return $field;
    }

    return null;
}

function fromContentByString(Page $page, string $field): ?Field {
    if( $page == null) {
        return null;
    } else {
        if($page->{$field}()->exists() && $page->{$field}()->isNotEmpty()) {
            return $page->{$field}();
        } else {
            return null;
        }
    }
}

function getThumbIfFileOnDisk(Field $field, string $thumbSize = 'square-500'){
    if($file = $field->toFile()){
        return $field->toFile()->thumb($thumbSize)->url();
    } else {
        return null;
    }
}

function fromContentToPage(Page $page, string $field): ?Page{
    if($field = fromContentByString($page, $field)){
        if($subpage = $field->toPage()){
            return $subpage;
        }
        return null;
    }
    return null;
}

function fromContentToPages(Page $page, string $field): ?Pages {
    if($field = fromContentByString($page, $field)){
        if($subpages = $field->toPages()){
            return $subpages;
        }
        return null;
    }
    return null;
}

function fromContentToFileUrl(Page $page, string $field, bool $toThumb = false, string $thumbSize = '100' ): ?string{
    // Field exists and is not empty
    if($field = fromContentByString($page, $field)){
        // Field is convertable to file Object
        if($file =  $field->toFile()){
            if($toThumb){
                return $file->thumb($thumbSize)->url();
            }
            return $file->url();
        }
        return null;
    }
    return null;
}