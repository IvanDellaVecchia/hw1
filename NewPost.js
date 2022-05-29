function onClick(event){
    const img = document.querySelector('#postImg');
    if(img.value.length == 0){
        document.querySelector('.error').textContent = "Inserisci un'immagine";
        event.preventDefault();
    }
}

const submit = document.querySelector('#SubmitPost');
submit.addEventListener('click', onClick);