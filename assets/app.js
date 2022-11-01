/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import 'bootstrap/dist/css/bootstrap.min.css';
import 'animate.css/animate.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'boxicons/css/boxicons.min.css';
import './template_assets/css/style.css';
import './styles/app.css';

// Modules
import 'bootstrap/dist/js/bootstrap.js';
import 'bootstrap/dist/js/bootstrap.bundle.js';
import Glightbox from "glightbox/src/js/glightbox";
import Isotope from 'isotope-layout/js/isotope.js';
import Swiper from 'swiper';

global.GLightbox = Glightbox;
global.Swiper = Swiper;
global.Isotope = Isotope;


// Js files
require( './template_assets/js/php-email-form/validate.js');
require ('./template_assets/js/purecounter/purecounter.js');
require('./template_assets/js/main.js');

// start the Stimulus application
import './bootstrap';
