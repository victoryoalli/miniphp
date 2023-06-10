import { defineConfig } from 'vite';
import path from 'path';

// https://vitejs.dev/config/
export default defineConfig({
    // plugins: [
    //     vue(),
    //     WindiCSS(),
    //     // json()

    // ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, '/resources/js'),
        },
    },
    build: {
        manifest: true,
        assetsDir: 'build/js',
        emptyOutDir:false,
        rollupOptions: {
            input: 'resources/js/app.js',
            output: {
                dir: 'public',
                // file: 'public/js/app.js',
                // type: 'iife',
            },
        },
    },
});
