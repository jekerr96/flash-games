import {BasePage} from "./base";

const HistoryPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
 
        },
    });

new HistoryPage(document.querySelector("body"));
