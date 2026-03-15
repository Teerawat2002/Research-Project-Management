import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        include: [
            'jquery',
            'select2/dist/js/select2.full.js'
        ],
    },

    // server: {
    //     host: '0.0.0.0',  // Make Vite available on all interfaces
    //     port: 5173,        // Ensure this port is open and not blocked
    //   }
});
