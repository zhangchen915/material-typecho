import {MDCSnackbar} from '@material/snackbar';

const comment = document.querySelector('.comment-form');
const snackbar = new MDCSnackbar(document.querySelector('.mdc-snackbar'));

function postBody() {
    let commentParams = [];
    comment.querySelectorAll('textarea,input').forEach(e => {
        commentParams.push(encodeURIComponent(e.name) + '=' + encodeURIComponent(e.value));

    });
    return commentParams.join('&');
}

function postComment() {
    const url = comment.dataset.url;
    fetch(url, {
        method: 'POST',
        body: postBody(),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        credentials: 'same-origin'
    }).then(res => {
        snackbar.show({message: "评论成功，审核通过后显示"})
    }).catch(error => {
        snackbar.show({message: "评论失败！"});
    });
}

if (comment) {
    const submit = comment.querySelector('#comment-submit');
    submit.addEventListener('click', e => {
        e.preventDefault();
        postComment();
    });
}
