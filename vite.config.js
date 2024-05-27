import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/dashboard.js',
                'resources/js/setting.js',
                'resources/js/trade.js',
                'resources/js/motivation.js',
                'resources/js/forums.js',
                'resources/js/mistakeNote.js',
                'resources/js/news.js',
                'resources/js/login.js',
                'resources/js/logout.js',
                'resources/sass/fontawesome.scss'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '$': 'jQuery'
        }
    },
    
});
