<?php
    $links = site()->children()->listed();
    foreach ($links as $link):
?>

<li class="nav-item">
    <a class="nav-link <?php if(page()->url() == $link->url()) {echo 'active';} ?>" href="<?= $link->url() ?>">
        <?= $link->title() ?>
    </a>
</li>

<?php endforeach ?>

<li class="nav-item">
    <a class="nav-link <?php if(page()->url() == site()->url() . '/search') {echo 'active';} ?>" href="<?= site()->url() . '/search' ?>">
        Suche
    </a>
</li>
