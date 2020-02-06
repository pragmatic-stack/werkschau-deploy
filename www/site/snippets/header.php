<?php

    // config options
    // $singlePage -> true | false | null
    // $linkConfig -> is needed for onpage scroll navigation

    $defaults = [ "brandHref" => site()->url(), "bodyClass" => 'ws-body--no-hero'];

    if(isset($singlePage)) {
        if($singlePage == true) {
            $defaults['brandHref'] = '#wsHero';
            $defaults['bodyClass'] = '';
        }
    }
?>

<body class="h-100 <?= $defaults['bodyClass'] ?>">

<header>
    <nav id="scrollTarget" class="navbar navbar-expand-lg navbar-light fixed-top ws-bg-light">
        <div class="container navbar-container">
            <a class="navbar-brand" href="<?= $defaults['brandHref'] ?>">Werkschau</a>

            <span class="navbar-text ml-auto">
                <span id="toggleSearch"><i class="fas fa-search"></i></span>
            </span>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($linkConfig)): ?>
                        <?= snippet('navigation-links-onepage', ['linkConfig' => $linkConfig]) ?>
                    <?php else: ?>
                        <?= snippet('navigation-links') ?>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
