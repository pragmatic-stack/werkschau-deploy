import './error.scss';

import { library, dom } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faEnvelope, faGlobe } from "@fortawesome/free-solid-svg-icons";
import {faBehance, faInstagram, faTwitter, faFacebook} from "@fortawesome/free-brands-svg-icons";

library.add(faSearch, faEnvelope, faGlobe, faBehance, faInstagram, faTwitter, faFacebook);
dom.watch();
