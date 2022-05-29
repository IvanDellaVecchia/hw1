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

        actions.appendChild(like);
        actions.appendChild(numLike);

        post.appendChild(author);
        post.appendChild(content);
        post.appendChild(actions);

        const section = document.querySelector('#CentralBar');
        section.appendChild(post);
    }
}

function onResponse(response){
    return response.json();
}

fetch("homePosts.php").then(onResponse).then(onJson);