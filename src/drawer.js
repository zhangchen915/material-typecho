import { MDCPersistentDrawer } from '@material/drawer';

const toggle = document.querySelector('#toggle');
const MDCdrawer = new MDCPersistentDrawer(document.querySelector('.mdc-drawer--persistent'));
toggle.addEventListener('click', e => {
    toggle.className = toggle.className ? '' : 'on';
    MDCdrawer.open = !MDCdrawer.open
})