import Control from "can-control";
import "can-construct-super";
import AOS from "aos";
import tippy from "tippy.js";


const BasePage = Control.extend({
    defaults: {}
}, {
    init() {
        this.$element = $(this.element);
        window.csrf = document.head.querySelector("[name='csrf-token']").content;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': window.csrf,
            }
        });

        AOS.init({
            duration: 600,
            offset: 100,

        });

        tippy(".js-tippy", {
            theme: "green"
        });
    },
});

export {BasePage};
