window.addEventListener("DOMContentLoaded", loadProfile);
function loadProfile() {
    const firstname = document.querySelector('#firstname');
    const lastname = document.querySelector('#lastname');
    const phone = document.querySelector('#phone');
    const chProfileForm = document.querySelector('#chProfileForm');

    chProfileForm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (validateAdd()) this.submit();
    });

    let validateAdd = () => {
        let isValid = true;

        if (isEmpty(firstname.value.trim())) {
            showErrorMessage(firstname, "Unesite ime");
            isValid = false;
        } else {
            hideErrorMessage(firstname);
        }

        if (isEmpty(lastname.value.trim())) {
            showErrorMessage(lastname, "Unesite prezime");
            isValid = false;
        } else {
            hideErrorMessage(lastname);
        }

        if (isEmpty(phone.value.trim())) {
            showErrorMessage(phone, "Unesite telefon");
            isValid = false;
        } else {
            hideErrorMessage(phone);
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