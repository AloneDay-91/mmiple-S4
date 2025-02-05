import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

import'bootstrap';
import'bootstrap/dist/css/bootstrap.min.css';

import'boxicons';
import'boxicons/css/boxicons.min.css';

import './styles/app.css';
import Duck from './js/duck.js';
import './js/panier.js';

const duck = new Duck('Waddles');

duck.quack();