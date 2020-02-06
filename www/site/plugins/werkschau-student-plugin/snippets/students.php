<?php
/**
 * Snippet to display all students that are published
 * Links to the published thesis
 */

$defaults = [
    'blockWidth' => 'full',
    'displayTitle' => false,
    'displayHeadline' => false,
    'showFilter' => false,
    'takeAll' => false,
];

if (isset($options)) {
    $settings = array_merge($defaults, $options);

    if (!isset($options['students'])) {
        $settings['students'] = site()->index()->unlisted()->filterBy('template', 'student');
    }
} else {
    $settings = $defaults;
    $settings['students'] = site()->index()->unlisted()->filterBy('template', 'student');
}

if (sizeof($settings['students']) > 0) : ?>

    <div class="col-md-12">
        <div class="row">
            <?php foreach ($settings['students'] as $student): ?>

                <div class="col-md-3">
                    <a href="<?= page($student)->url() ?>">
                        <article class="ws-card">
                            <figure class="ws-bg-img ws-img--square scale">
                                <img src="<?= page($student)->thesis()->toPage()->presentation()->toFile()->thumb('square-500')->url(); ?>">
                            </figure>
                            <section class="ws-card--detail ws-bg-light-gray">
                                <h2 class="ws-card--title"><?= page($student)->title() ?></h2>
                                <p class="ws-card--subtitle"><?= page($student)->title() ?></p>
                                <p class="ws-card--description"> <?= page($student)->courseOfStudy() ?></p>
                            </section>
                        </article>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php endif ?>


