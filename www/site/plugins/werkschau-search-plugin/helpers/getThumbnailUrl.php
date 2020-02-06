<?php
function getThumbnailUrl($page){
    $image = 'http://placehold.it/100x100';

    switch ($page->template()->name()) {
        case 'student':
            if($page->profileImage()->isNotEmpty() && $page->profileImage()->exists()) {
                $image =  $page->profileImage()->toFile()->thumb('250')->url();
            } ;
            break;
        case 'speaker':
            if($page->profileImg()->isNotEmpty() && $page->profileImg()->exists()) {
                $image = $page->profileImg()->toFile()->thumb('250')->url();
            };
            break;
        case 'abschlussarbeit':
            if($page->presentation()->isNotEmpty() && $page->presentation()->exists()) {
                $image = $page->presentation()->toFile()->thumb('250')->url();
            };
            break;
        case 'semesterarbeit':
            if($page->heroImage()->isNotEmpty() && $page->heroImage()->exists()) {
                $image = $page->heroImage()->toFile()->thumb('250')->url();
            };
            break;
        default:
            $image = 'http://placehold.it/100x100';
    }

    return $image;
}