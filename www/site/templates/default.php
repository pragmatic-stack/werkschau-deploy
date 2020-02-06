<?php
/**
 * Template for the default page
 * This template gets used if no other template is specified
 */

    snippet('head');
    snippet('header');
?>
    <main>
        <article class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="ws-section--headline__centered">
                        <?= page()->title() ?>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= page()->pageContent()->kirbytext() ?>
                </div>
            </div>
        </article>
    </main>
<?php
    snippet('footer');
?>