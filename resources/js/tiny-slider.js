import { tns } from "tiny-slider/src/tiny-slider";

(function () {
    "use strict";

    // Tiny Slider
    if ($(".tiny-slider").length) {
        $(".tiny-slider").each(function () {
            this.tns = tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: true,
                controls: false,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                nav: false,
                speed: 500,

            });
        });
    }

    if ($(".tiny-slider-navigator").length) {
        $(".tiny-slider-navigator").each(function () {
            $(this).on("click", function () {
                if ($(this).data("target") == "prev") {
                    $("#" + $(this).data("carousel"))[0].tns.goTo("prev");
                } else {
                    $("#" + $(this).data("carousel"))[0].tns.goTo("next");
                }
            });
        });
    }

    // Slider widget page
    if ($(".single-item").length) {
        $(".single-item").each(function () {
            tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: false,
                controls: true,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                nav: false,
                speed: 500,
            });
        });
    }

    if ($(".featured-products").length) {
        $(".featured-products").each(function () {
            tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: false,
                controls: true,
                items: 2,
                nav: false,
                speed: 500,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                responsive: {
                    1000: {
                        items:6
                    },
                    600: {
                        items: 4,
                    },
                    480: {
                        items: 2,
                    },
                },
            });
        });
    }

    if ($(".top-selling-products").length) {
        $(".top-selling-products").each(function () {
            tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: false,
                controls: true,
                items: 2,
                nav: false,
                speed: 500,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                responsive: {
                    1000:{
                        items: 6,
                    },
                    600: {
                        items: 4,
                    },
                    480: {
                        items: 2,
                    },
                },
            });
        });
    }


    if ($(".categories").length) {
        $(".categories").each(function () {
            tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: false,
                controls: true,
                items: 2,
                nav: false,
                speed: 500,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                responsive: {
                    1000:{
                        items: 6,
                    },
                    600: {
                        items: 4,
                    },
                    480: {
                        items: 2,
                    },
                },
            });
        });
    }

    if ($(".brands").length) {
        $(".brands").each(function () {
            tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: false,
                controls: true,
                items: 2,
                nav: false,
                speed: 500,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                responsive: {
                    1000:{
                        items: 6,
                    },
                    600: {
                        items: 4,
                    },
                    480: {
                        items: 2,
                    },
                },
            });
        });
    }

    if ($(".multiple-items").length) {
        $(".multiple-items").each(function () {
            tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: false,
                controls: true,
                items: 2,
                nav: false,
                speed: 500,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                responsive: {
                    600: {
                        items: 3,
                    },
                    480: {
                        items: 2,
                    },
                },
            });
        });
    }

    if ($(".responsive-mode").length) {
        $(".responsive-mode").each(function () {
            tns({
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: false,
                controls: true,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                items: 1,
                nav: true,
                speed: 500,
                responsive: {
                    600: {
                        items: 3,
                    },
                    480: {
                        items: 2,
                    },
                },
            });
        });
    }

    if ($(".center-mode").length) {
        $(".center-mode").each(function () {
            tns({
                container: this,
                mouseDrag: true,
                autoplay: false,
                controls: true,
                center: true,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                items: 1,
                nav: false,
                speed: 500,
                responsive: {
                    600: {
                        items: 2,
                    },
                },
            });
        });
    }

    if ($(".fade-mode").length) {
        $(".fade-mode").each(function () {
            tns({
                mode: "gallery",
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: true,
                controls: true,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                controlsContainer : false,
                nav: false,
                speed: 500,
            });
        });
    }
    if ($(".home-mode").length) {
        $(".home-mode").each(function () {
            tns({
                mode: "gallery",
                container: this,
                slideBy: "page",
                mouseDrag: true,
                autoplay: true,
                controls: false,
                arrowKeys:false,
                prevButton:false,
                nextButton:false,
                controlsContainer : false,
                nav: true,
                autoHeight: true,
                speed: 500,
            });
        });
    }
})();
