<?php
/**
 * Template for the sections page
 * This template gets used if no other template is specified
 */

snippet('head');
snippet('header');
?>
    <main>
        <?php if($displayTitle): ?>
        <article class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="ws-section--headline__centered">
                        <?= page()->title() ?>
                    </h1>
                </div>
            </div>
        </article>
        <?php endif ?>

        <?php if (isset($pageContent)): ?>

            <?php foreach ($pageContent as $section): $config = $section['sectionConfig'] ?>

                <?php e($config['withBackground'], '<div class="ws-bg-light-gray">') ?>

                    <article <?= $config['containerAttributes'] ?>>
                        <section class="row">

                        <?php if($config['displayTitle']): ?>
                            <div class="col-md-12">
                                <h1 class="ws-section--headline__centered">
                                    <?= $config['title'] ?>
                                </h1>
                            </div>
                        <?php endif ?>

                        <?php foreach ($section['blocks'] as $block): ?>
                            <?php
                                $part = $block['part'];
                                snippet($part->intendedTemplate(), ['part' => $part, 'options' => $block['options']])
                            ?>
                        <?php endforeach; ?>

                        </section>
                    </article>

                <?php e($config['withBackground'], '<div/>') ?>

            <?php endforeach; ?>

        <?php endif ?>
    </main>
<?php
snippet('footer', ['additionalScripts' => $mapBlocksJs]);
?>