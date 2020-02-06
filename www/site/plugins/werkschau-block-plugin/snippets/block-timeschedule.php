<?php
$events = $part->events()->toStructure();

// group events by Date
$groups = array();

foreach ($events as $event) {
    $dateStr = strval($event->datum());

    if (array_key_exists($dateStr, $groups)) {
        array_push($groups[$dateStr], $event);
    } else {
        $groups[$dateStr] = array($event);
    }
};

// default block settings
$defaults = [
    'blockWidth'        => 'quarter',
    'displayTitle'      => fromContentByString($part, 'displayTitle'),
    'displayHeadline'   => fromContentByString($part, 'displayHeadline'),
];

// provided options override defaults
if(isset($options)){
    $settings = array_merge($defaults, $options);
} else {
    $settings = $defaults;
}
?>

<section class="<?= getWidthClass($settings['blockWidth']) ?>">

    <?php
    // handle title and headline
    snippet('default-title-headline', ['block' => $part, 'settings' => $settings])
    ?>

    <?php foreach ($groups as $key => $item): ?>

            <div class="ws-timetable">
                <h3 class="ws-timetable-day">
                    <?= getGermanWeekday(date("D", strtotime($key))) ?>,
                    <?= date("d. ", strtotime($key)); ?>
                    <?= getGermanMonthShort(date("M", strtotime($key))); ?>
                </h3>


                <?php foreach ($item as $event): ?>
                    <p class="ws-timetable-item">
                       <span class="ws-timetable-item-time">
                         <?= $event->von() ?>
                           <?php if ($event->bis()->length() > 0) {
                               echo ' – ' . $event->bis();
                           } ?> Uhr
                       </span>
                         <span class="ws-timetable-item-description">
                             <?= $event->beschreibung() ?>
                         </span>
                    </p>
                <?php endforeach ?>
            </div>

    <?php endforeach; ?>
</section>