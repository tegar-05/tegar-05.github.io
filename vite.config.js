import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: (id) => {
                    if (id.includes('node_modules')) {
                        if (id.includes('jquery') || id.includes('alpinejs')) {
                            return 'vendor';
                        }
                        return 'vendor';
                    }
                    if (id.includes('resources/css')) {
                        return 'styles';
                    }
                    if (id.includes('resources/js')) {
                        return 'app';
                    }
                },
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    let extType = info[info.length - 1];
                    if (/\.(png|jpe?g|svg|gif|tiff|bmp|ico)$/i.test(assetInfo.name)) {
                        extType = 'images';
                    } else if (/\.(woff2?|eot|ttf|otf)$/i.test(assetInfo.name)) {
                        extType = 'fonts';
                    }
                    return `${extType}/[name]-[hash][extname]`;
                },
                chunkFileNames: 'js/[name]-[hash].js',
                entryFileNames: 'js/[name]-[hash].js',
            },
        },
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug'],
            },
            mangle: {
                safari10: true,
            },
        },
        cssCodeSplit: true,
        sourcemap: false,
        chunkSizeWarningLimit: 1000,
    },
    optimizeDeps: {
        include: ['jquery', 'alpinejs'],
    },
});
