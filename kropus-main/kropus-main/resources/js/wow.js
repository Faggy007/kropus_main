import WOW from 'wow.js';

window.WOW = WOW;

window.initWow = function() {
    new WOW().init({
        animateClass: 'animate__animated',
        duration: '1.5s'
    });
}
