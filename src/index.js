import {
    highlightAll
} from 'prismjs'
import 'prismjs/components/prism-typescript'
import 'prismjs/components/prism-json'
import 'prismjs/components/prism-python'
import 'prismjs/components/prism-java'
import Zooming from 'zooming'
import Pjax from 'Pjax'
import {
    MDCRipple
} from '@material/ripple/index'
import {
    MDCTextField
} from '@material/textfield';

import './goTop';
import './index.scss';
import 'prismjs/themes/prism.css';

document.querySelectorAll('.mdc-button').forEach(e => {
    MDCRipple.attachTo(e);
})

document.querySelectorAll('.mdc-text-field').forEach(e => {
    new MDCTextField(e);
})

window.onload = () => {
    if (navigator.userAgent.match(/AppleWebKit.*Mobile.*/)) {
        import ('./drawer').then();
    } else {
        import ('./background').then(background => {
            background.render();
        })
    }

    new Pjax({
        elements: "a",
        selectors: ['.pjax-header', '.pjax-content']
    })

    new Zooming({
        customSize: '125%',
        bgColor: 'rgba(26,26,26,.65)',
        enableGrab: false
    }).listen('.post-content img');

    document.addEventListener('pjax:success', highlightAll);
};

document.addEventListener('copy', e => {
    let author = document.querySelector('.logo a').textContent;
    const selection = window.getSelection()
    if (e.path[1].className === 'post-content') {
        author = e.path[2].querySelector("a[rel='author']").textContent;
    }
    e.clipboardData.setData('text/plain',
        `${selection.toString()}\n作者：${author}\n原文地址：${document.domain}`);
    e.preventDefault();
})