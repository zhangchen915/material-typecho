const comment = document.querySelector('.comment-form');
const submit = comment.querySelector('button[name="submit"]');

function postBody() {
    let commentParams = [];
    comment.querySelectorAll('textarea,input,button').forEach(e => {
        console.log(e.name);
        commentParams.push(encodeURIComponent(e.name) + '=' + encodeURIComponent(e.value));

    });
    return commentParams.join('&');
}

function postComment() {
    fetch(comment.dataset.url, {
        method: 'POST',
        body: postBody(),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        credentials: 'same-origin'
    }).then(res => console.log('Success:', res))
        .catch(error => console.error('Error:', error));
}

if (submit) {
    submit.addEventListener('click', e => {
        e.preventDefault();
        postComment();
    });
}
