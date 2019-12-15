import {BasePage} from "./base";
import DualListbox from "dual-listbox";

const EditPage = BasePage.extend({
        defaults: {}
    },
    {
        init() {
            this._super();
            this.dualListbox = new DualListbox('select');
        },
    });

new EditPage(document.querySelector("body"));
