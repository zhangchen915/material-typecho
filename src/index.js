import {highlightAll} from 'prismjs'
import 'prismjs/components/prism-typescript'
import 'prismjs/components/prism-json'
import 'prismjs/components/prism-python'
import 'prismjs/components/prism-java'
import Zooming from 'zooming'
import {Pjax} from 'pjax-api'
import {MDCRipple} from '@material/ripple/index'
import {MDCTextField} from '@material/textfield';
import {MDCTabBar} from '@material/tab-bar';

import './scrollTop';
import './comment'
import './index.scss';
import 'prismjs/themes/prism.css';

const postContent = document.querySelector('.post-content');
const search = document.querySelector('#search');

const zoom = new Zooming({
    customSize: '125%',
    bgColor: 'rgba(26,26,26,.65)',
    enableGrab: false
});

const pjax = new Pjax({
    areas: ['.pjax-content'],
    link: 'a'
});

function init() {
    document.querySelectorAll('.mdc-button').forEach(e => {
        MDCRipple.attachTo(e);
    });

    document.querySelectorAll('.mdc-text-field').forEach(e => {
        new MDCTextField(e);
    });

    zoom.listen('.post-content img');
}

window.onload = () => {
    init();
    if (navigator.userAgent.match(/AppleWebKit.*Mobile.*/)) {
        import ('./drawer').then();
    } else {
        import ('./compatible').then();
        import ('./background').then(background => {
            background.render();
        });

        new MDCTabBar(document.querySelector('.mdc-tab-bar'));

        if (document.querySelector('#search')) document.querySelector('#search').onchange = e => {
            if (e.target.value) pjax.assign(e.target.value);
        };

        document.querySelector('.search-button').addEventListener('click', e=> {
            if(document.querySelector('#search input').value){
                search.dispatchEvent(new Event('submit'));
                document.querySelector('#search input').value = '';
            }else{
                document.querySelector('#search input').focus();
            }
        });

        search.addEventListener('submit', e => {
            e.preventDefault();
            const value = e.target[0].value;
            if (value) pjax.assign(`//${window.location.host}/index.php/search/${value}`);
        })
    }

    window.addEventListener('pjax:load', () => {
        init();
        highlightAll();
    });
};

if (postContent) {
    postContent.addEventListener('copy', e => {
        let author = document.querySelector('.logo a').textContent;
        const selection = window.getSelection();
        if (e.path[1].className === 'post-content') {
            author = e.path[2].querySelector("a[rel='author']").textContent;
        }
        e.clipboardData.setData('text/plain',
            `${selection.toString()}\n作者：${author}\n原文地址：${document.domain}`);
        e.preventDefault();
    });
}