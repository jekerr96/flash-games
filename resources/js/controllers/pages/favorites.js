import {BasePage} from "./base";

const FavoritesPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
 
        },
    });

new FavoritesPage(document.querySelector("body"));
