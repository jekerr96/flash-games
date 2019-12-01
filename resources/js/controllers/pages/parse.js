import {BasePage} from "./base";

const ParsePage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
            this.from = this.element.querySelector(".js-from");
            this.to = this.element.querySelector(".js-to");
            this.form = this.element.querySelector(".js-form-parse");
            this.info = this.element.querySelector(".js-info");
        },

        ".js-form-parse submit"(el, ev) {
            ev.preventDefault();
            if (this.load) return;

            this.load = true;
            this.curPage = this.from.value;
            this.maxPage = this.to.value;
            this.showInfo("Загружается страница №" + this.curPage);
            this.sendAjax();
        },

        sendAjax() {
            $.ajax({
                url: "/parse/" + this.curPage,
                processData: false,
                contentType: false,
                data: new FormData(this.form),
                type: "POST",
                success: (data) => {
                    this.curPage++;
                    this.showInfo();

                    if (this.curPage <= this.maxPage) {
                        this.showInfo("Загружается страница №" + this.curPage);
                        this.sendAjax();
                    } else {
                        this.load = false;
                        this.showInfo("Загрузка завершена");
                    }
                },
                error: () => {
                    this.showInfo("Произошла ошибка на странице №" + this.curPage);
                }
            });
        },

        showInfo(text) {
            this.info.innerHTML = text;
        }
    });

new ParsePage(document.querySelector("body"));
