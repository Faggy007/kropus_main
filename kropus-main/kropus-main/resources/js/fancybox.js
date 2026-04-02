import {Fancybox} from "@fancyapps/ui";

window.Fancybox = Fancybox;
onReady(function () {
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });
});
