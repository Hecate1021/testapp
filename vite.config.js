import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
     server: {
        port: 3000, // Change this to an available port, e.g., 3000
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // Our new line you can change app.scss to whatever.scss
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
