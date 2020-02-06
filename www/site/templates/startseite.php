<?php
/**
 * Template for the comfort-zone page
 * Contents should be configured in the backend by setting the desired contents.
 * Site specific styles are defined 'assets/css/startseite.css'.
 * Snippet styles are defined in the chunk files 'assets/css/shared/...'.
 * Block styles are defined in the chunk files 'assets/css/blocks/...'.
 * Stylesheet is automatically set by kirby, configured in 'site/snippets/head.php'.
 */
?>

<?php
$headConfig = [
    'metaDescription' => 'Comfort-Zone — Winter-Werkschau 2020 — Abschlussarbeiten der Fakultät Gestaltung im Wintersemester 2019/20 an der Hochschule Augsburg.',
]
?>

<?php snippet('head', $headConfig) ?>
<?php snippet('header', ['singlePage' => true, 'linkConfig' => $linkConfig]); ?>

<div class="container-fluid">
    <div class="row p-0">
        <?php if (isset($heroSnippet)) {
            echo $heroSnippet;
        } ?>
    </div>
</div>


<main data-syp="scroll" data-target="#scrollTarget" data-offset="88">
    <article id="programm" class="container ws-section">
        <section class="row">

            <?php if (isset($infoSnippet)) {
                echo $infoSnippet;
            } ?>
            <?php if (isset($timetableSnippet)) {
                echo $timetableSnippet;
            } ?>

        </section>
    </article>

    <article id="absolventen" class="ws-bg-wrapper__grey">
        <div class="container ws-section">
            <!-- students headline -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="ws-section--headline__centered mb-5">
                        Abschlussarbeiten
                    </h1>
                </div>
            </div>

            <!-- Theses are added here -->
            <div class="row">
                <?php if (isset($theses)): ?>
                    <?php foreach ($theses as $thesis): ?>

                        <div class="col-md-3">
                            <a href="<?= $thesis->url() ?>">
                                <article class="ws-card">
                                    <figure class="ws-bg-img ws-img--square scale">
                                        <img src="<?= $thesis->presentation()->first()->toFile()->thumb('square-500')->url(); ?>">
                                    </figure>
                                    <section class="ws-card--detail ws-bg-light">
                                        <h2 class="ws-card--title"><?= $thesis->title() ?></h2>
                                        <p class="ws-card--subtitle"><?= $thesis->student() ?></p>
                                        <p class="ws-card--description"> <?= $thesis->beschreibung()->excerpt(200) ?></p>
                                    </section>
                                </article>
                            </a>
                        </div>

                    <?php endforeach; ?>
                <?php endif ?>
            </div>
        </div>
    </article>

    <!-- ANFAHRT -->

    <article id="anfahrt" class="container ws-section">
        <!-- sponsors headline -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="ws-section--headline__centered">
                    Anfahrt
                </h1>
            </div>
        </div>
        <div class="row">
            <?php if (isset($addressSnippet)) {
                echo $addressSnippet;
            } ?>
            <?php if (isset($approachPublicSnippet)) {
                echo $approachPublicSnippet;
            } ?>
            <?php if (isset($approachCarSnippet)) {
                echo $approachCarSnippet;
            } ?>
        </div>
    </article>

    <?php if (isset($maps)): ?>
        <div class="container-fluid p-0">
            <?= $maps ?>
        </div>
    <?php endif ?>

    <!-- SPONSORS -->
    <article id="sponsoren" class="container ws-section">
        <!-- sponsors headline -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="ws-section--headline__centered">
                    Sponsoren
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 ws-scale">
                <img src="https://placehold.it/600x200?text=WS+Sponsor" class="img-fluid mb-2">
            </div>
            <div class="col-md-2 ws-scale">
                <img src="https://placehold.it/600x200?text=WS+Sponsor" class="img-fluid mb-2">
            </div>
            <div class="col-md-2 ws-scale">
                <img src="https://placehold.it/600x200?text=WS+Sponsor" class="img-fluid mb-2">
            </div>
            <div class="col-md-2 ws-scale">
                <img src="https://placehold.it/600x200?text=WS+Sponsor" class="img-fluid mb-2">
            </div>
            <div class="col-md-2 ws-scale">
                <img src="https://placehold.it/600x200?text=WS+Sponsor" class="img-fluid mb-2">
            </div>
            <div class="col-md-2 ws-scale">
                <img src="https://placehold.it/600x200?text=WS+Sponsor" class="img-fluid mb-2">
            </div>
        </div>
    </article>
</main>

<?php
snippet('footer', ['additionalScripts' => [page()->maps()->toPage()->initMapJs()]]);
?>