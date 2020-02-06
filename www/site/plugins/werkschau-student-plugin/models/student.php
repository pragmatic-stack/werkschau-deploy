<?php
/**
 * StudentPage model to handle custom add fields
 *
 * @author      Konstantin Kraska <office@kraska-systems.de>
 * @copyright   2019 Konstantin Kraska
 * @license     MIT <https://opensource.org/licenses/MIT>
 */

class StudentPage extends Page {
    public static function hookPageCreate($page){
        // get value of add field remoteUrl
        $firstName = $page->firstName();
        $lastName = $page->lastName();
        $slug = $firstName . '-' . $lastName;

        // update page field content
        $page->update(array(
            'title' => $firstName . ' ' . $lastName,
            'firstName' => $firstName,
            'lastName' => $lastName
        ));


        try{
            $page->changeSlug(Str::slug($firstName . '-' . $lastName));
        } catch (Kirby\Exception\DuplicateException $e) {
            $slug = $slug . '-' . random_int(0, 500);
            $page->changeSlug(Str::slug(strval($slug)));
        }
    }

    public static function hookChangeStatusBefore ($page, $status){
        $children = $page->children();

        $thesis = $children->unlisted()->findBy('template', 'abschlussarbeit');
        if($thesis == null){
            throw new Exception('Du musst deine Abschlussarbeit eintragen und veröffentlichen.');
        }
    }
}