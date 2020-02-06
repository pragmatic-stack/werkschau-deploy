<?php
/**
 * Template for speakers-overview-page ('/speakers')
 */
?>

<?= snippet('head', ['metaDescription' => "Wo sind die Speaker? — Winter-Werkschau 2020 — Abschlussarbeiten der Fakultät Gestaltung im Wintersemester 2019/20 an der Hochschule Augsburg."]) ?>
<?= snippet('header', ['version' => 'minimal-back']) ?>

<?php $speakers = $site->find('speakers')->children()->unlisted(); ?>

<main class="stack">

   <h1><?= page()->title() ?></h1>

   <?php foreach ($speakers as $speaker): ?>

      <?php
       // TODO: Outsource to Controller
      $academicGrade = $speaker->academicGrade();
      $name = $speaker->name();
      $lastName = $speaker->lastName();

      $websiteUrl = $speaker->websiteUrl();
      $websiteUrlCleaned = preg_replace('#^https?://#', '', $websiteUrl);
      $behanceUrl = $speaker->behanceUrl();
      $instagramUrl = $speaker->instagramUrl();

      $profileImg = $speaker->profileImg()->toFile();
      $biography = $speaker->biography();

      $works = $speaker->children()->unlisted()->filterBy('intendedTemplate', 'speaker-work');
      ?>

      <article class="speaker">
         <h2><?= $academicGrade.' '.$name.' '.$lastName ?></h2>

         <section class="contact">
            <?php
            e($websiteUrl->isNotEmpty(), '<a href="'.$websiteUrl.'">'.$websiteUrlCleaned.'</a>', null);

            e($behanceUrl->isNotEmpty() || $instagramUrl->isNotEmpty(), '<div class="social_links">', null);
               e($behanceUrl->isNotEmpty(), '<a href="'.$behanceUrl.'">Be</a>', null);
               e($instagramUrl->isNotEmpty(), '<a href="'.$instagramUrl.'">In</a>', null);
            e($behanceUrl->isNotEmpty() || $instagramUrl->isNotEmpty(), '</div>', null);
            ?>
         </section>

         <section class="about flex_row col_2">
             <?php if (isset($profileImg)): ?>
                 <img srcset="<?= $profileImg->srcset(); ?>"
                      sizes="<?= sizes(); ?>"
                      src="<?= $profileImg->url() ?>" />
              <?php endif ?>
            <?= $biography->kt() ?>
         </section>

         <section class="projects flex_row margin--small">
            <?php foreach ($works as $work): ?>
               <div class="project">
                  <?php $image = $work->heroImg()->toFile() ?>
                  <img srcset="<?= $image->srcset('square'); ?>"
                       sizes="<?= sizes(); ?>"
                       src="<?= $image->url() ?>" />
                  <h3><?= $work->title() ?></h3>
                  <p><?= $work->description() ?></p>
               </div>
            <?php endforeach; ?>
         </section>
      </article>

   <?php endforeach; ?>

</main>

<?= snippet('footer') ?>
