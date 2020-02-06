<?php
/**
 * Location Controller to provide data for the location.php template
 *
 * @author      Florian Kapaun <hello@florian-kapaun.de>
 * @copyright   2020 Florian Kapaun
 */

return function ($page) {

   $title = $page->title();
   $intro = $page->intro();
   $marquee = site()->findBy('intendedTemplate', 'block-marquee');

   return [
      'title' => $title,
      'intro' => $intro,
      'marquee' => $marquee,
   ];
};
