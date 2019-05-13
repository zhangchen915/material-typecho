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
    }).then(() => {
        snackbar.show({message: "评论成功，审核通过后显示"})
    }).catch(() => {
        snackbar.show({message: "评论失败！"});
    });
}

function getCookie(name) {
    const arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
    if (arr != null) return decodeURI(arr[2]);
    return null;
}

function autoFill(prefix) {
    const inputName = ['author', 'url', 'mail'];
    inputName.forEach(e => {
        document.getElementById(e).value = getCookie(`${prefix}__typecho_remember_${e}`);
        console.log(getCookie(`${prefix}__typecho_remember_${e}`))
    });
}

if (comment) {
    const submit = comment.querySelector('#comment-submit');
    if (comment.dataset.login) autoFill(comment.dataset.urlPrefix);
    submit.addEventListener('click', e => {
        e.preventDefault();
        postComment();
    });
}