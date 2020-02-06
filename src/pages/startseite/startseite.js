// global css is generated into an index.css file
// additional css resources
import './startseite.scss';
import 'mapbox-gl/dist/mapbox-gl.css';

// additional js resources
import 'bootstrap/js/dist/scrollspy';
import * as SmoothScroll from 'smooth-scroll';
import mapboxgl from 'mapbox-gl';

// initialize smooth scrolling and one page scrollspy
window.addEventListener('load', () => {
    new SmoothScroll(
        'a[href*="#"]',
        {
            speed: 300,
            speedAdDuration: true,
            offset: 86,
        }
    );

    $('body').scrollspy({target: '#scrollTarget', offset: 86});
});

// make mapbox accessible for settings in php
window.mapboxgl = mapboxgl;