<?php
/**
 * SpeakerPage model to handle custom add fields
 *
 * @author      Konstantin Kraska <office@kraska-systems.de>
 * @copyright   2019 Konstantin Kraska
 * @license     MIT <https://opensource.org/licenses/MIT>
 */
?>
<?php

class SpeakerPage extends Page
{
    public static function hookPageCreate($page)
    {
        // get value of add field remoteUrl
        $vorname = $page->name();
        $nachname = $page->lastName();
        $slug = $vorname . '-' . $nachname;

        // update page field content
        $page->update(array(
            'title' => $vorname . ' ' . $nachname,
            'vorname' => $vorname,
            'nachname' => $nachname
        ));

        try {
            $page->changeSlug(Str::slug($vorname . '-' . $nachname));
        } catch (Kirby\Exception\DuplicateException $e) {
            $slug = $slug . '-' . random_int(0, 500);
            $page->changeSlug(Str::slug(strval($slug)));
        }
    }
}