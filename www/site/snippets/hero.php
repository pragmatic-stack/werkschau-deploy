<!-- werkschau hero section -->
<?php
    $randomThesis = site()->index()->filterBy('template', 'abschlussarbeit')->shuffle()->last();
?>
<article id="wsHero"
         style="background-image: url(<?= $randomThesis->presentation()->first()->toFile()->url() ?>">
</article>