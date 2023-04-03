import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
            'vendor/laravel/breeze/resources/views/**/*.blade.php', // Adicionado para incluir as views do Breeze
        ]),
    ],
});
