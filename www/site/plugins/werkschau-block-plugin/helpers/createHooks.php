<?php
function createBlueprintHooks($blueprintsDir, $sectionsDir, $fieldsDir)
{
    $blueprints = array_diff(scandir($blueprintsDir), array('..', '.'));
    $sections = array_diff(scandir($sectionsDir), array('..', '.'));
    $fields = array_diff(scandir($fieldsDir), array('..', '.'));

    $hooks = array();
    foreach ($blueprints as $blueprint) {
        $hook = 'pages/' . basename($blueprint, '.yml');
        $dir = $blueprintsDir . '/' . $blueprint;
        $hooks += [$hook => $dir];
    }
    foreach ($sections as $section) {
        $hook = 'sections/' . basename($section, '.yml');
        $dir = $sectionsDir . '/' . $section;
        $hooks += [$hook => $dir];
    }

    foreach ($fields as $field) {
        $hook = 'fields/' . basename($field, '.yml');
        $dir = $fieldsDir . '/' . $field;
        $hooks += [$hook => $dir];
    }
    return $hooks;
}

;
function createPhpHooks($rootDir)
{
    $templates = array_diff(scandir($rootDir), array('..', '.'));
    $hooks = array();
    foreach ($templates as $template) {
        $hook = basename($template, '.php');
        $dir = $rootDir . '/' . $template;
        $hooks += [$hook => $dir];
    }
    return $hooks;
}
