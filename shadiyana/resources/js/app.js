import Alpine from 'alpinejs';

import { initializeMarkdownEditor } from './markdown-editor';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initializeMarkdownEditor();
});