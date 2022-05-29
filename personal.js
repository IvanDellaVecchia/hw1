function eliminaPost(event){
    const button = event.currentTarget;
    fetch('eliminaPost.php?q='+button.dataset.postIDbutton);
}

function onJson(json){
    for(let i = json.length-1; i>=0 ; i--){

        const post = document.createElement('div');
        post.classList.add('post');
        const author = document.createElement('div');
        author.classList.add('author');

        const proImg = document.createElement('img');
        if(json[i].profile){
            proImg.src = json[i].profile;
        } else {
            proImg.src = "Images/Profile.png"
        }
        proImg.alt = "author";
        const div = document.createElement('div');
        const aname = document.createElement('p');
        aname.classList.add('AName');
        aname.textContent = json[i].name + " " + json[i].surname;
        const auser = document.createElement('p');
        auser.classList.add('AUser');
        auser.textContent = "@" + json[i].username;

        div.appendChild(aname);
        div.appendChild(auser);
        author.appendChild(proImg);
        author.appendChild(div);

        const content = document.createElement('div');
        content.classList.add('imgAuthor');
        const postImg = document.createElement('img');
        postImg.src = json[i].image;
        postImg.alt = "postImg";
        const desc = document.createElement('p');
        desc.classList.add('description');
        desc.textContent = json[i].description;

        content.appendChild(postImg);
        content.appendChild(desc);
        
        const actions = document.createElement('div');
        actions.classList.add('actions');
        const like = document.createElement('button');
        like.textContent = "";
        like.classList.add('Like');
        like.dataset.postID = json[i].id;

        if(json[i].post){
            like.classList.remove('unliked');
            like.classList.add('liked');
            like.removeEventListener('click', addLike);
            like.addEventListener('click', removeLike);
        } else {
            like.classList.remove('liked');
            like.classList.add('unliked');
            like.removeEventListener('click', removeLike);
            like.addEventListener('click', addLike);
        }

        const numLike = document.createElement('div');
        numLike.textContent = json[i].nlikes;
        numLike.dataset.postID = json[i].id;

        const elimina = document.createElement('a');
        elimina.href = 'personal.php';
        const buttonElimina = document.createElement('button');
        buttonElimina.textContent = 'Elimina post';
        buttonElimina.classList.add('elimina');
        buttonElimina.dataset.postIDbutton = json[i].id;
        buttonElimina.addEventListener('click', eliminaPost);
        elimina.appendChild(buttonElimina);

        actions.appendChild(like);
        actions.appendChild(numLike);
        actions.appendChild(elimina)

        post.appendChild(author);
        post.appendChild(content);
        post.appendChild(actions);

        const section = document.querySelector('#CentralBar');
        section.appendChild(post);
  
    }
}

function onJsonInfo(json){
    personal = document.querySelector('#personal')
    if(json.profile){
        personal.querySelector('img').src = json.profile;
    } else {
        personal.querySelector('img').src= "Images/Profile.png";
    }
    personal.querySelector('.AName').textContent = json.name + " " + json.surname;
    personal.querySelector('.AUser').textContent = '@'+json.username; 
}

function onResponse(response){
    return response.json();
}

fetch("personalPosts.php").then(onResponse).then(onJson);
fetch("checkUser.php").then(onResponse).then(onJsonInfo);


function profile(event){
    const submit = event.currentTarget;
    const img = submit.querySelector('#profileImg');
    if(img.value.length == 0){
        submit.querySelector('.error').textContent = "Inserisci un'immagine";
        event.preventDefault();
    }
}

function profileButton(){
    document.forms['profile'].classList.remove('hidden');
}

document.forms['profile'].addEventListener('submit', profile);
document.querySelector('#profileButton').addEventListener('click', profileButton);