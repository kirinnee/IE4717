function addSeconds(inDate, seconds) {
    return new Date(inDate.getTime() + seconds * 1000);
}

function validName(name) {
    return !!name.match(/^[a-zA-Z](\s*[a-zA-Z]+)*$/);
}

function validEmail(email) {
    return !!email.match(/^[a-zA-Z0-9\-\.]+@([a-zA-Z][a-zA-Z0-9\-]*\.){1,3}[a-zA-Z][a-zA-Z0-9\-]{1,2}$/);
}

function validWorkExperience(workexp) {
    return !!workexp.match(/^.+$/);
}

function validDate(date) {
    const chosen = new Date(date);
    const now = new Date();
    now.setHours(0,0,0,0);
    return chosen > addSeconds(now, 60*60*24);
}

function validateAll() {
    const nameEle = document.querySelector("#name-form input");
    const nameValid = validName(nameEle.value);

    const emailEle = document.querySelector("#email-form input");
    const emailValid = validEmail(emailEle.value);

    const startDateEle  = document.querySelector("#start-date-form input");
    const startDateValid = validDate(startDateEle.value);
    
    return nameValid && emailValid && startDateValid;
}

function validation(input, message, validator, name) {
    const inputEle = document.querySelector(input);
    const messageEle = document.querySelector(message);

    inputEle.addEventListener('input', (event)=> {
        const a = validator(event.target.value);
        if(!a) {
            messageEle.innerHTML = `Invalid ${name}`;
        } else {
            messageEle.innerHTML = "✅";
        }
    });
}

function registerValidation() {
    validation("#name-form input", "#name-form .error", validName, "name Only Alphabets and spaces allowed");
    validation("#email-form input", "#email-form .error", validEmail, "email. Must in be format of name@domain");
    validation("#start-date-form input", "#start-date-form .error", validDate, "start date. Must be before today");
    validation("#work-exp-form textarea", "#work-exp-form .error", validWorkExperience, "work experience. Must not be empty");
}

registerValidation();