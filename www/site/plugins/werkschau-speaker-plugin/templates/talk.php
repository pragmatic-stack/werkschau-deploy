<?php
/**
 * This page shouldn't be accessible in the current project. Therefore it's
 * referring to the speakers page.
 */
?>

<?php go($page->speaker()->url(), 301); ?>
