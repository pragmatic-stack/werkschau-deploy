/**
 * @author: Konstantin Kraska <office@kraska-systems.de>
 *
 *  index js file to provide shared and global js and css
 *  chunk common.js and common.css is created and injected to pages
 *
 *  info: page specific js and css go into the page css/js files
 */
import 'assets/css/globals.scss';
// set vendor resources and initial scripts
import 'bootstrap/dist/js/bootstrap.bundle';
// search initializazion for global search functionality
import { initSearch } from 'assets/js/shared/search';
// for promise usage
import "regenerator-runtime";
// global icons
// icon dependencies
import {library, dom} from "@fortawesome/fontawesome-svg-core";
import {faEnvelope} from "@fortawesome/free-regular-svg-icons";
import {faSearch, faGlobe, faDesktop, faBars} from "@fortawesome/free-solid-svg-icons";
import {faBehance, faInstagram, faYoutube, faFacebook, faTwitter} from "@fortawesome/free-brands-svg-icons";

library.add(faSearch, faEnvelope, faGlobe, faDesktop, faBehance, faInstagram, faYoutube, faFacebook, faTwitter, faBars);
dom.watch();

// listener is added here because search is initialized on every page
window.addEventListener('load', () => {
    initSearch({
        searchToggleId: 'toggleSearch',
        searchContainerId: 'wsSearch',
        searchCloseId: 'closeSearch',
        searchInputId: 'searchControl',
        resultContainerId: 'searchResults',
        rootUrl: window.werkschau.rootUrl
    });
});