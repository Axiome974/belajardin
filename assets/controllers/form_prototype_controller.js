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
        this.target = document.querySelector("#"+this.element.dataset.target);
        this.element.addEventListener('click', this.stimuleMe.bind(this));
    }

    stimuleMe(){
        let prototype = this.target.dataset.prototype;
        this.target.innerHTML += prototype;
    }

}
