import {
    MDCPersistentDrawer
} from '@material/drawer';

const toggle = document.querySelector('#toggle');
const drawerEl = document.querySelector('.mdc-drawer--persistent');
const MDCdrawer = new MDCPersistentDrawer(drawerEl);
toggle.addEventListener('click', e => {
    toggle.className = toggle.className ? '' : 'on';
    MDCdrawer.open = !MDCdrawer.open
})

drawerEl.addEventListener('MDCPersistentDrawer:close', () => {
    if (toggle.className) toggle.className = '';
})