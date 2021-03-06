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
        let  button = document.createElement("button");

        button.classList = "btn btn-primary";
        button.innerText = "Stimulation!";
        button.addEventListener("click", this.stimuleMe );
        this.element.append(button);
    }

    stimuleMe(){
        window.alert("Je suis stimulus!")
    }

}
