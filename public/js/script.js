/**
 * Easy selector helper function
 */
const select = (el, all = false) => {
    el = el.trim();
    if (all) {
        return [...document.querySelectorAll(el)];
    } else {
        return document.querySelector(el);
    }
};

/**
 * Easy on scroll event listener
 */
const onscroll = (el, listener) => {
    el.addEventListener("scroll", listener);
};

/**
 * Preloader
 */
let preloader = select(".preloader-main");
let div = select(".preloader-wapper");
let body = document.body;

if (preloader) {
    window.addEventListener("load", () => {
        setTimeout(function () {
            div.classList.add("loaded");
        }, 2000);
        setTimeout(function () {
            preloader.remove();
            body.classList.remove("unscrollable");
        }, 3000);
    });
}

/**
 * Toggle .header-scrolled class to #navbar when page is scrolled
 * Fixed navbar
 */

let selectHeader = select("#navbar");
let prevScrollpos = window.pageYOffset;

window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        selectHeader.style.top = "0";
    } else {
        selectHeader.style.top = "-6rem";
    }
    prevScrollpos = currentScrollPos;
};
