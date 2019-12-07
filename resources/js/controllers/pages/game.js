import {BasePage} from "./base";

const GamePage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();

        },
    });

new GamePage(document.querySelector("body"));
