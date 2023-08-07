window.addEventListener("DOMContentLoaded", sideBar);
function sideBar() {
    const value = document.querySelector("#show_price");
    const input = document.querySelector("#price");
    value.textContent = input.value;
    input.addEventListener("input", (event) => {
        value.textContent = event.target.value;
    });
    const value2 = document.querySelector("#period_result");
    const input2 = document.querySelector("#period");
    value2.textContent = input2.value;
    input2.addEventListener("input", (event) => {
        value2.textContent = event.target.value;
    });
    const estate_typ = document.querySelector("#type");
    const loCation = document.querySelector("#location");
    const searchFrm = document.querySelector("#searchFrm");
    searchFrm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (validateMsg()) this.submit();
    });

    let validateMsg = () => {
        let isValid = true;

        if (isEmpty(estate_typ.value)) {
            showErrorMessage(estate_typ, "Molimo odaberite tip nekretnine");
            isValid = false;
        } else {
            hideErrorMessage(estate_typ);
        }

        if (isEmpty(loCation.value)) {
            showErrorMessage(loCation, "Molimo odaberite željenu lokaciju");
            isValid = false;
        } else {
            hideErrorMessage(loCation);
        }

        return isValid;

    }
}
const isEmpty = value => value === '';
const showErrorMessage = (field, message) => {
    const error = field.nextElementSibling;
    error.innerText = message;
};
const hideErrorMessage = (field) => {
    const error = field.nextElementSibling;
    error.innerText = '';
}