<?php
class BlockMaps extends Page {

    public function initMapJs() {
        $accessToken = site()->mapboxAccessToken();
        $lat = $this->locationLat();
        $long = $this->locationLong();
        $zoom = $this->zoom();
        $style = $this->style();
        $mapId = $this->mapId();

        $scriptTag = '<script type="text/javascript">';
        $js =
            'mapboxgl.accessToken = "' . $accessToken . '";
            const mapbox = document.getElementById("' . $mapId . '");
            var map = new mapboxgl.Map({
                container: mapbox.id, // container id
                style: mapbox.dataset.mapboxStyle, // stylesheet location
                center: [mapbox.dataset.mapboxLng, mapbox.dataset.mapboxLat], // starting position [lng, lat]
                zoom: mapbox.dataset.mapboxZoom // starting zoom
            });';

        $scriptTagClose = '</script>';

        return $scriptTag .  $js . $scriptTagClose;
    }
}