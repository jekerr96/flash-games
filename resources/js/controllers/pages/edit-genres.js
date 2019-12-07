import {BasePage} from "./base";

const EditGenres = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();

        },

        ".js-delete-genre click"(el) {
            if (!confirm("Удалить?")) return;

            $.ajax({
                url: "/delete-genre/",
                type: "post",
                data: {id: el.dataset.id},
                success: (data) => {
                    if (data.success) {
                        el.closest(".js-genre").remove();
                    }
                }
            });
        }
    });

new EditGenres(document.querySelector("body"));
