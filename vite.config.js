import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { globSync } from 'glob';


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/admin/css/adminlte.css',
                'resources/admin/js/adminlte.js',
                ...globSync('resources/admin/plugins/**/*.js'),
                ...globSync('resources/admin/plugins/**/*.css'),
                ...globSync('resources/admin/custom/js/**/*.js')
            ],
            refresh: true,
        })
    ],
    logLevel: "info",
});
