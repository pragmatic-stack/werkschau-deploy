<?php
$headConfig = [
    'snippetCSS' => ['assets/css/blocks/block-students.css'],
    "metaDescription" => "Wo sind die Absolventen? — Winter-Werkschau 2020 — Abschlussarbeiten der Fakultät Gestaltung im Wintersemester 2019/20 an der Hochschule Augsburg."
]
?>

<?php snippet('head', $headConfig) ?>
<?php snippet('header') ?>


    <main>
        <?php snippet('students'); ?>
    </main>

<?php snippet('footer') ?>