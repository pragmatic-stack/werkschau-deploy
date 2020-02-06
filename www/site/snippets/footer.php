<?php
/**
 * Snippet for the site footer
 * contents should be configured in the panel by setting the desired contents
 * js files should be edited in file assets/css/templates/footer.js
 * used block-scripts are automatically set by werkschau-block-plugin
 *
 * Additional resource handling
 * set the snippet in the template with additional variables
 * for vendor js files use snippet('footer', ['vendorJS' => ['assets/vendor/*.js']])
 * for snippet js files use snippet('footer', ['snippetJS' => ['assets/js/snippet/*.js']])
 * for block js files use snippet('footer', ['blockJS' => ['assets/js/block/*.js']])
 *
 * @author      Konstantin Kraska <office@kraska-systems.de>
 * @author      Florian Kapaun <florian.kapaun@hs-augsburg.de>
 * @copyright   2019 Konstantin Kraska & Florian Kapaun
 * @license     MIT <https://opensource.org/licenses/MIT>
 */
?>

<?php $footerLinks = $site->index()->filterBy('inFooterMenu', 'true'); ?>

<?= snippet('search-form') ?>

<footer class="container">
    <article class="row">
        <section class="col-md-12">
            <div class="ws-divider-simple">
                <span></span>
            </div>
        </section>

        <!-- Footer Logo -->
        <section class="col-md-3 text-sm-center">
            <img id="footerLogo" class="img-fluid" src=" <?= asset('assets/img/hs-augsburg-logo.svg')->url() ?>">
        </section>

        <!-- Faculty -->
        <section class="col-md-3 text-sm-center">
            <p>
                <span>&copy; <?= date('Y') ?></span><br>
                <a href="<?= $site->facultyWebsite() ?>"><?= $site->content()->faculty() ?></a><br>
                <a href="<?= $site->organisationWebsite() ?>"><?= $site->content()->name() ?></a>
            </p>
        </section>

        <!-- Adress -->
        <section class="col-md-3 text-sm-center">
            <p>
                <a href="<?= $site->content()->googleMapsLink() ?>" target="_blank">
                    <?= $site->content()->cityabbrevation() ?><br>
                    <?= $site->content()->street() ?><br>
                    <?= $site->content()->city() ?> <?= $site->content()->countryabbreviation() ?>
                </a>
            </p>
        </section>

        <!-- Footer Links -->
        <?php if (sizeof($footerLinks) > 0): ?>
             <nav  class="col-md-3 text-sm-center">
                 <p>
                    <?php foreach ($footerLinks as $footerLink): ?>
                       <a href="<?= $footerLink->url() ?>"><?= $footerLink->title() ?></a><br>
                    <?php endforeach; ?>

                    <a href="<?= $site->facultyWebsite() ?>">Website</a>
                 </p>
             </nav>
        <?php endif ?>
    </article>

</footer>

    <script>
      window.werkschau = {
          "rootUrl": "<?= site()->url(); ?>"
      }
    </script>

    <?= js(['assets/js/index.js', '@auto']) ?>

    <?php if(isset($additionalScripts)) {
        foreach ($additionalScripts as $additionalScript){
            echo $additionalScript;
        }
    }?>

</body>
</html>
