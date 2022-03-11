import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        this.prevElement = document.querySelector("#"+(this.element.id)+"_preview");
        this.prevElement.classList = this.element.value;
        this.element.addEventListener('change', this.stimuleMe.bind(this));
    }

    stimuleMe(){
       this.prevElement.classList = this.element.value ;
    }

}
