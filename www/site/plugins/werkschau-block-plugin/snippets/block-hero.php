<?php
// heroType -> staticImage || imageSlider || contentSlider
// staticImage -> for staticImage type
// sliderImages -> for imageSlider type
// selectedContent -> for contentSlider type

$type = $part->heroType();
$context = null;

// switch rendering
switch ($type) {
    case 'staticImage':
        $context = [fromContentToFileUrl($part, 'staticImage')];
        break;

    case 'imageSlider':
        $images = fromContentByString($part, 'sliderImages');
        $context = [];
        if (isset($images)) {
            foreach ($images->toFiles() as $image) {
                $context[] = $image->url();
            }
        }
        break;

    case 'contentSlider':
        // render the content images
        $theses = fromContentByString($part, 'selectedContent');
        $context = [];

        if(isset($theses)){
            $theses = $theses->toPages();

            foreach ($theses as $thesis){
                $context[] = $thesis->presentation()->toFiles()->first()->thumb('slider')->url();
            }
        }

        break;
}
?>
<div class="col-md-12">
    <div id="wsHero" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php for ($i = 0; $i < sizeof($context); $i++): ?>
                <div class="carousel-item <?php if($i == 0){ echo 'active'; } ?>">
                    <div class="ws-slide" style="background-image: url(<?= $context[$i] ?>)"></div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>


