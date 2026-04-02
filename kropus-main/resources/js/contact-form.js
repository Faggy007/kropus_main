import axios from "axios";

function sendContactForm(type, data, successCallback, errorCallback) {
    axios.post("/api/contact-form", {
        type: type,
        data: data
    })
    .then(response => {
        successCallback(response);
    })
    .catch(error => {
        errorCallback(error);
    });
}

/**
 * @param type
 * @param $el
 * About form:
 * .js-form - form element
 * .js-formSuccessRemove - element to remove after success
 * .js-formSuccessShow - element to show after success
 */
function sendHtmlContactForm(type, $el) {
    const inputs = Array.from($el.querySelectorAll("input, textarea"));
    const data = inputs.reduce(
        (object, key) => ({ ...object, [key.name]: key.value }),
        {}
    );
    let successCallback = function(response) {
        if (response.data.success) {
            $el.reset();

            const $successRemove = $el.querySelector(".js-formSuccessRemove");
            if ($successRemove) {
                $successRemove.remove();
            }

            const $successShow = $el.querySelector(".js-formSuccessShow");
            if ($successShow) {
                $successShow.style.display = "block";
            }
        }
    };
    let errorCallback = function(error) {
        if (error.message) {
            alert(error.message);
        } else {
            alert("An error occurred while submitting the form.");
        }
    };
    sendContactForm(type, data, successCallback, errorCallback);
}

window.sendContactForm = sendContactForm;
window.sendHtmlContactForm = sendHtmlContactForm;

export { sendContactForm, sendHtmlContactForm };
