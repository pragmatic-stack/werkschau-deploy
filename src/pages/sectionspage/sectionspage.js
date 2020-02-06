import './sectionspage.scss';
import 'mapbox-gl/dist/mapbox-gl.css';

// mapbox gl usage
import mapboxgl from 'mapbox-gl';

// icon dependencies
import {library, dom} from "@fortawesome/fontawesome-svg-core";
import {faEnvelope} from "@fortawesome/free-regular-svg-icons";
import {faSearch, faGlobe, faDesktop} from "@fortawesome/free-solid-svg-icons";
import {faBehance, faInstagram, faYoutube, faFacebook, faTwitter} from "@fortawesome/free-brands-svg-icons";

library.add(faSearch, faEnvelope, faGlobe, faDesktop, faBehance, faInstagram, faYoutube, faFacebook, faTwitter);
dom.watch();

window.mapboxgl = mapboxgl;