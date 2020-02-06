<?php
/**
 * Template for the student pages
 * This template gets used for every student page.
 * Contents should be configured in the backend by setting the desired contents.
 * Site specific styles are defined 'assets/css/student.css'.
 * Snippet styles are defined in the chunk files 'assets/css/shared/...'.
 * Block styles are defined in the chunk files 'assets/css/blocks/...'.
 * Stylesheet is automatically set by kirby, configured in 'site/snippets/head.php'.
 */
?>

<?php snippet('head', ['customColors' => $customColors, 'metaDescription' => "$studentName — Winter-Werkschau 2020 — Absolventen-Portfolio — Abschlussarbeit im Wintersemester 2019/20 an der Hochschule Augsburg."]) ?>
<?php snippet('header') ?>

<main>
    <article class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <h1 class="ws-section--headline__centered  mb-2">
                    <?= $studentName ?>
                </h1>
                <div class="ws-prev-next-nav">
                    <div class="arrows">
                    <?php if(isset($prevStudentUrl)): ?>
                        <a href="<?= $prevStudentUrl ?>"><i class="fas fa-chevron-left"></i></a>
                    <?php endif; ?>

                    <?php if(isset($nextStudentUrl)): ?>
                        <a href="<?= $nextStudentUrl ?>"><i class="fas fa-chevron-right"></i></a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Thesis detail Data -->
            <div class="col-md-4">
                <div class="ws-bg-img ws-img--square ws-student-info"
                     style="background-image: url(<?= isset($profileImage) ? $profileImage : 'https://placehold.it/500x500?text=no+image' ?>)">
                    <div class="ws-student-info__contact">

                        <?php if(sizeOf($socialLinks) > 0) {
                            foreach ($socialLinks as $link): ?>

                                <a href="<?= isset($link['hrefPrefix']) ? $link['hrefPrefix'] . ':' : '' ?><?= $link['value'] ?>">
                                    <button type="button" class="ws-button ws-button__small ws-button__outline">
                                        <i class="<?= $link['icon'] ?>"></i>
                                    </button>
                                </a>

                         <?php endforeach;  } ?>
                    </div>
                </div>

                <div class="ws-thesis--data">
                    <h2><?= $thesis->headline(); ?></h2>
                    <h3><?= $thesis->subheadline(); ?></h3>
                    <p><?= $thesis->description() ?></p>
                </div>

                <div class="ws-thesis--data">
                    <p><strong>Studiengang</strong><br>
                        <?= $courseOfStudies ?></p>

                    <p><strong>Betreuer</strong><br>
                        <?php
                            if(isset($supervisors)){
                                for ($i = 0; $i < sizeof($supervisors); $i++){
                                    echo $supervisors[$i];
                                    if( $i < sizeof($supervisors) - 1) { echo '<br>'; }
                                }
                            }
                         ?>
                    </p>

                    <p><strong>Gebäude / Raum</strong><br>
                        <?= $thesisRoomAbbrev ?></p>
                </div>

            </div>
            <!-- Thesis feature image -->
            <div class="col-md-8 ws-thesis--images">
                <?php if(isset($vimeoLink)): ?>
                    <div class="video">
                        <?= vimeo($vimeoLink, [], ['width' => '100%', 'height' => 'auto', 'frameborder' => 0]); ?>
                    </div>
                <?php endif ?>

                <?php if(isset($thesisImages)): ?>
                    <?php foreach ($thesisImages as $thesisImage): ?>
                        <img src="<?= $thesisImage->thumb('1000')->url() ?>" />
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </article>

    <?php if(isset($semesterprojects)): ?>

    <article class="container">
        <div class="row">
            <div class="col-md-12 ws-section">
                <div class="ws-section--separator__centered">
                    <div></div>
                    <h2>Semesterarbeiten</h2>
                </div>
            </div>
        </div>
        <div class="row">
        <?php foreach ($semesterprojects as $project): ?>

                <div class="col-md-4">
                    <article class="ws-card">
                        <figure class="ws-bg-img ws-img--4_3 scale"
                                style="background-image: url(<?php if($img = fromContentToFileUrl($project, 'heroImage')) { echo $img; }  ?>)"></figure>
                        <section class="ws-card--detail ws-bg-light-gray">
                            <h2 class="ws-card--title"><?= $project->headline() ?></h2>
                            <p class="ws-card--subtitle"><?= $project->student() ?></p>
                            <p class="ws-card--description"><?= $project->description() ?></p>
                        </section>
                    </article>
                </div>

        <?php endforeach; ?>
        </div>
    </article>

    <?php endif ?>
</main>

<?php snippet('footer') ?>
