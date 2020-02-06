<?= snippet('head', ['metaDescription' => "Wo sind die Inhalte? — Winter-Werkschau 2020 — Abschlussarbeiten der Fakultät Gestaltung im Wintersemester 2019/20 an der Hochschule Augsburg."]) ?>
<?= snippet('header') ?>

<main>

    <article class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="ws-section--headline__centered">
                        <?= page()->title() ?>
                    </h1>
                </div>
                <div class="col-md-12 mb-4 text-center">
                    <label for="onPageSearchInput">
                        <input type="text" placeholder="... was genau suchst du?" id="onPageSearchInput"/>
                    </label>
                </div>
            </div>
            <div class="row" id="onPageSearchResults">

            </div>
        </article>

</main>

<?= snippet('footer') ?>
