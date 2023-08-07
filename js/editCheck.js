window.addEventListener("DOMContentLoaded", init);
function init() {
    const loCation = document.querySelector('#location');
    const details = document.querySelector('#details');
    const period = document.querySelector('#period');
    const price = document.querySelector('#price');
    const propertyEditFrm = document.querySelector('#propertyEditFrm');

    propertyEditFrm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (validateEdit()) this.submit();
    });
    let validateEdit = () => {
        let isValid = true;

        if (isEmpty(loCation.value.trim())) {
            showErrorMessage(loCation, "Molimo popunite polje lokacija");
            isValid = false;
        } else if (!isValidLoaction(loCation.value.trim())) {
            showErrorMessage(loCation, "Unos mora da bude u formatu gread, naselje");
            isValid = false;
        } else {
            hideErrorMessage(loCation);
        }

        if (isEmpty(details.value.trim())) {
            showErrorMessage(details, "Unesite neke detalje");
            isValid = false;
        } else {
            hideErrorMessage(details);
        }

        if (isEmpty(period.value.trim())) {
            showErrorMessage(period, "Unesite period iznajmljivanja");
            isValid = false;
        } else {
            hideErrorMessage(period);
        }

        if (isEmpty(price.value.trim())) {
            showErrorMessage(price, "Unesite cenu");
            isValid = false;
        } else {
            hideErrorMessage(price);
        }

        return isValid;
    }
}
const isEmpty = value => value === '';
const isValidLoaction = (location) => {
    let rex = /\w+, \w*/g;
    let pattern = location.match(rex);
    if(pattern!=null){
        if(pattern.length==1) {
            return true;
        }
    }else if(pattern==null){
        return false;
    }
}
const showErrorMessage = (field, message) => {
    const error = field.nextElementSibling;
    error.innerText = message;
};
const hideErrorMessage = (field) => {
    const error = field.nextElementSibling;
    error.innerText = '';
}