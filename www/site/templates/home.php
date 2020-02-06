<?php
/**
 * Template for the home page
 * Contents should be configured in the backend by setting the desired contents.
 * Site specific styles are defined 'assets/css/home.css'.
 * Snippet styles are defined in the chunk files 'assets/css/shared/...'.
 * Block styles are defined in the chunk files 'assets/css/blocks/...'.
 * Stylesheet is automatically set by kirby, configured in 'site/snippets/head.php'.
 */

if($redirect = fromContentByString(page(), 'redirect'))
{
    if($redirect == 'true'){
        if($redirectUrl = fromContentByString(page(), 'redirectPage'))
        {
            $page = $redirectUrl->toPage();

            go($page->url());
        }
    }
}


