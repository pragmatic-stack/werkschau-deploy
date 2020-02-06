<?php
/**
 * Snippet to display all students that are published
 */
?>

<?php $speakers = site()->find('speakers')->children()->unlisted(); ?>

<?php foreach ($speakers as $speaker): ?>

   <?php
   $profileImg = $speaker->profileImg()->isNotEmpty() ? $speaker->profileImg()->toFile() : null;
   $academicGrade = $speaker->academicGrade();
   $name = $speaker->name();
   $lastName = $speaker->lastName();
   $biography = $speaker->biography();
   $biographyExcerpt = $speaker->biographyexcerpt();
   $websiteUrl = $speaker->websiteUrl();
   $websiteUrlCleaned = preg_replace('#^https?://#', '', $websiteUrl);
   $works = $speaker->children()->unlisted()->filterBy('intendedTemplate', 'speaker-work');
   ?>

   <section class="speaker_item flex_row col_3">

      <div class="speaker_item--info">
         <h3><?= $academicGrade .' '. $name .' '. $lastName ?></h3>

         <!-- Links -->
         <?php e($websiteUrl->isNotEmpty(), '<a href="'.$websiteUrl.'">'.$websiteUrlCleaned.'</a>', null); ?>

         <!-- Bio -->
         <p class="biography"><?php e($biographyExcerpt->isNotEmpty(), $biographyExcerpt, $biography); ?></p>
      </div>

      <!-- Profile Image -->
      <?php if($profileImg): ?>
         <img srcset="<?= $profileImg->srcset('square'); ?>"
              sizes="<?= sizes('col_3'); ?>"
              src="<?= $profileImg->url() ?>" />
      <?php endif ?>

      <div class="speaker_teaser--carousel owl-carousel owl-theme">
         <?php foreach ($works as $work): ?>
            <div class="--carousel__item">
                <?php $workImg = $work->heroImg()->toFile() ?>
                <img srcset="<?= $workImg->srcset('square'); ?>"
                     sizes="<?= sizes('col_3'); ?>"
                     src="<?= $workImg->url() ?>" />
            </div>
         <?php endforeach ?>
      </div>

   </section>



<?php endforeach ?>
