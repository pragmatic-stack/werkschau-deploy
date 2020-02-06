<?php
/**
 * Template for the main thesis
 * contents should be configured in the panel by setting the desired contents
 * styles should be edited in file assets/css/templates/abschlussarbeit.css
 * block-stylesheet is automatically set by werkschau-block-plugin
 *
 * @author      Konstantin Kraska <office@kraska-systems.de>
 * @copyright   2019 Konstantin Kraska
 * @license     MIT <https://opensource.org/licenses/MIT>
 */
?>

<?php
    // currently just a redirect to the student
    go($page->parent()->url(), 301);
?>

<?php snippet('head') ?>
<?php snippet('header') ?>

<main>
    <!-- Thesis content goes here -->
    <?php $thesis = $page->title() ?>
    <div class="thesis">
        <?= $thesis ?>
    </div>

    <?= $nextThesisUrl ?><br>
    <?= $prevThesisUrl ?><br>
    <?= $randomThesisUrl ?><br>
    <?= $student->firstName() . $student->courseOfStudy() . $student->lastName()?>
</main>

<?php snippet('footer') ?>
