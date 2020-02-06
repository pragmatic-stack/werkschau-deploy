<?php
/**
 * Snippet to display all theses works published by students
 */
?>

<?php if ($theses = $kirby->collection('work/theses')): ?>

    <section class="theses-grid">

        <?php foreach ($theses as $thesis): ?>

            <?php
                $title = $thesis->title();
                $courseOfStudy = $thesis->courseOfStudy();
                $student = $thesis->student();
                $excerpt = $thesis->beschreibung()->excerpt(100);
                $coverUrl = $thesis->file() ? $thesis->file()->url() : 'https://placehold.it/500x300';
                $cover = asset($coverUrl);
                $files = $thesis->files();
                $url = $thesis->url();
                $tags = $thesis->tags();
            ?>

            <div class="thesis-item">
                <?= $title ?> <br>
                <?= $courseOfStudy ?> <br>
                <?= $student ?> <br>
                <?= $excerpt ?> <br>
                <?= $tags ?> <br>
                <img srcset="<?= $cover->srcset(); ?>"
                     src="<?= $cover->url() ?>" />
                <a href="<?= $url ?>">Link</a>
            </div>

        <?php endforeach ?>

    </section>

<?php endif ?>
