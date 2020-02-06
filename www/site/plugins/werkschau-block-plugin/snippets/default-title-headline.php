<?php
if (isset($settings) && isset($block)): ?>

    <?php if ($settings['displayTitle'] != null && $settings['displayTitle'] == 'true'): ?>
        <h1 class="ws-section--headline"><?= $block->title(); ?></h1>
    <?php endif ?>

    <?php if ($settings['displayHeadline'] != null && $settings['displayHeadline'] == 'true'): ?>
        <h3><?= $block->headline(); ?></h3>
    <?php endif ?>

<?php endif ?>
