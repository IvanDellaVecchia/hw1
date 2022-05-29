function logIn(event){
    if(form.username.value.length == 0 ||
        form.password.value.length == 0){
            event.preventDefault();
            document.querySelector('p.errore').textContent = 'Riempi tutti i campi';
        }
}

const form = document.forms['Form'];
form.addEventListener('submit', logIn);