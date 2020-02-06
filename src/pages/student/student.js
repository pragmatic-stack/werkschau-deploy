import './student.scss';

import { library, dom } from "@fortawesome/fontawesome-svg-core";
import { faSearch, faEnvelope, faGlobe, faChevronLeft, faChevronRight } from "@fortawesome/free-solid-svg-icons";
import { faBehance, faInstagram, faTwitter, faFacebook } from "@fortawesome/free-brands-svg-icons";

library.add(faSearch, faEnvelope, faGlobe, faBehance, faInstagram, faTwitter, faFacebook, faChevronLeft, faChevronRight);
dom.watch();
