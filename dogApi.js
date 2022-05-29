function dogJson(json){
    let index = Math.floor(Math.random()*171);
    url = json[index].image.url;
    
    const div = document.querySelector('#imgContainer');
    let divImg;
    if (divImg = div.querySelector('img')){
        divImg.src = url;
    }else{
        const img = document.createElement('img');
        img.src = url;
        div.appendChild(img);
    }
}

function dogResponse(response){
    return response.json();
}

function dogClick(){
    fetch("dog.php").then(dogResponse).then(dogJson);
}

document.querySelector('#CreaFoto').addEventListener('click', dogClick);