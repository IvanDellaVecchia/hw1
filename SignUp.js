let errors = {
    name: false,
    surname: false,
    email: false,
    username: false,
    password: false
};

function checkNome(event){
    const Check = event.currentTarget;

    if(Check.value.length == 0){
        document.querySelector('#nome div').textContent = "Questo campo non può essere vuoto";
        errors.name = false;
    } else {
        document.querySelector('#nome div').innerHTML = "";
        errors.name = true;
    }
}

function checkCognome(event) {
    const Check = event.currentTarget;

    if(Check.value.length == 0){
        document.querySelector('#cognome div').textContent = "Questo campo non può essere vuoto";
        errors.surname = false;
    } else {
        document.querySelector('#cognome div').innerHTML = "";
        errors.surname = true;
    }
}

function checkEmail(event) {
    const Check = event.currentTarget;

    if(Check.value.length == 0){
        document.querySelector('#email div').textContent = "Questo campo non può essere vuoto";
        errors.email = false;
    } else if(!(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/).test(Check.value)){
        document.querySelector('#email div').textContent = "Email non valida";
        errors.email = false;
    }
     else {
        document.querySelector('#email div').innerHTML = "";
        errors.email = true;
    }
}

function onJson(json){
    if(json){
        document.querySelector('#username div').innerHTML = "Username già in uso";
        errors.username = false;
    } else {
        document.querySelector('#username div').innerHTML = "";
        errors.username = true;
    }
}

function onResponse(response){
    return response.json();
}

function checkUsername(event) {
    const Check = event.currentTarget;

    if(Check.value.length == 0){
        document.querySelector('#username div').textContent = "Questo campo non può essere vuoto";
        errors.username = false;
    } else fetch("checkUser.php?q="+Check.value).then(onResponse).then(onJson);
}

function checkPassword(event) {
    const Check = event.currentTarget;

    if(Check.value.length == 0){
        document.querySelector('#password div').textContent = "Questo campo non può essere vuoto";
        errors.password = false;
    } else if(Check.value.length < 8){
        document.querySelector('#password div').textContent = "La password deve contenere almeno 8 caratteri";
        errors.password = false;
    } else if(!Check.value.match(/[A-Z]/g)||!Check.value.match(/[a-z]/g)||!Check.value.match(/[0-9]/g)){
        document.querySelector('#password div').textContent = "La password deve contenere almeno una lettera maiuscola, una lettera minuscola e un numero";
        errors.password = false;
    }else {
        document.querySelector('#password div').innerHTML = "";
        errors.password = true;
    }
}


function submit(event){
        
    let countTrue = 0;
    for(const error in errors){
        if(errors[error] == true){
            countTrue++;
        }
    }
    if(countTrue != 5){
        event.preventDefault();
        if(Nome.value.length == 0) document.querySelector('#nome div').textContent = "Questo campo non può essere vuoto";
        if(Cognome.value.length == 0) document.querySelector('#cognome div').textContent = "Questo campo non può essere vuoto";
        if(Email.value.length == 0) document.querySelector('#email div').textContent = "Questo campo non può essere vuoto";
        if(Username.value.length == 0) document.querySelector('#username div').textContent = "Questo campo non può essere vuoto";
        if(Password.value.length == 0) document.querySelector('#password div').textContent = "Questo campo non può essere vuoto";
    }
}


const Nome = document.querySelector('#nome input');
Nome.addEventListener("blur", checkNome);
const Cognome = document.querySelector('#cognome input');
Cognome.addEventListener("blur", checkCognome);
const Email = document.querySelector('#email input');
Email.addEventListener("blur", checkEmail);
const Username = document.querySelector('#username input');
Username.addEventListener("blur", checkUsername);
const Password = document.querySelector('#password input');
Password.addEventListener("blur", checkPassword);

const form = document.forms['Form'];
form.addEventListener('submit', submit);