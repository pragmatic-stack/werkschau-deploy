<?php header("Content-Type: text/html; charset=utf-8"); ?>
<?php $robots = isset($robots) ? $robots : 'index'; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="robots" content="<?= $robots ?>">

    <?php if(isset($metaDescription)): ?>
    <meta name="description" content="<?= $metaDescription ?>">
    <?php endif ?>

    <title><?= isset($title) ? $title : page()->title() ?></title>

    <?= css(['assets/css/index.css', '@auto']) ?>
</head>

