import './searchPage.scss';
import { initOnPageSearch } from '../../assets/js/shared/search';

// icon dependencies
import {library, dom} from "@fortawesome/fontawesome-svg-core";
import {faEnvelope} from "@fortawesome/free-regular-svg-icons";
import {faSearch, faGlobe, faDesktop} from "@fortawesome/free-solid-svg-icons";
import {faBehance, faInstagram, faYoutube, faFacebook, faTwitter} from "@fortawesome/free-brands-svg-icons";

library.add(faSearch, faEnvelope, faGlobe, faDesktop, faBehance, faInstagram, faYoutube, faFacebook, faTwitter);
dom.watch();

$(window).on('load', () => {

    initOnPageSearch({
        resultContainerId: 'onPageSearchResults',
        searchInputId: 'onPageSearchInput',
        baseUrl: window.werkschau.rootUrl
    });

});
