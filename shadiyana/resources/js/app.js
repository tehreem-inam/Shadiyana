import Alpine from 'alpinejs';
import { initializeMarkdownEditor } from './markdown-editor';
import { initializeCityLocationPicker } from './maps/city-location-picker';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initializeMarkdownEditor();
});

document.addEventListener('DOMContentLoaded', () => {

    initializeCityLocationPicker();

});