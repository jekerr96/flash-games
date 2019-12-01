import Control from "can-control";
import "can-construct-super";

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
    },
});

export {BasePage};
