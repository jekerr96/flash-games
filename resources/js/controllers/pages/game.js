import {BasePage} from "./base";

const GamePage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();

        },

        ".js-favorite click"(el) {
            $.ajax({
                url: "/favorites/",
                type: "post",
                data: {id: el.dataset.id},
                success: (data) => {
                    el.classList.toggle("active", data.result);

                    el._tippy.setContent(data.result ? "Удалить из закладок" : "Добавить в закладки");
                }
            });
        }
    });

new GamePage(document.querySelector("body"));
