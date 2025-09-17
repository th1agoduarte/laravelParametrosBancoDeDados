import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import commonjs from '@rollup/plugin-commonjs';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/src/main.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        commonjs(),
    ],
    define: {
        global: 'globalThis',
    },
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js/src'),
            '@themeConfig': resolve(__dirname, 'resources/js/theme.config.js'),
            '~nouislider/distribute/nouislider.min.css': resolve(__dirname, 'node_modules/nouislider/dist/nouislider.min.css'),
            'qs': resolve(__dirname, 'resources/js/src/utils/qs-wrapper.js'),
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
                silenceDeprecations: ['import', 'global-builtin', 'legacy-js-api'],
                includePaths: [
                    'node_modules',
                    'resources/js/src/assets',
                ],
            },
        },
    },
    build: {
        sourcemap: false,     // ajuda a depurar
        minify: true,         // minimiza o código para produção
        chunkSizeWarningLimit: 1000,
        emptyOutDir: false,
        rollupOptions: {
            output: {
                // Configuração muito conservadora para chunking
                manualChunks: (id) => {
                    // Apenas separa algumas bibliotecas essenciais e conhecidamente seguras
                    if (id.includes('node_modules/vue/') || id.includes('node_modules/@vue/')) {
                        return 'vue';
                    }
                    if (id.includes('node_modules/axios/')) {
                        return 'axios';
                    }
                    // Todo o resto fica no chunk principal
                },
            },
        },
        commonjsOptions: {
            include: [/lodash/, /nouislider/, /qs/, /node_modules/],
            transformMixedEsModules: true,
        },
    },
    optimizeDeps: {
        include: ['lodash', 'nouislider'],
    },
    esbuild: {
        minifyIdentifiers: true, // evita renomear identificadores
        keepNames: false, // não mantém nomes de funções e classes
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost',
            port: 5173,
        },
        watch: {
            usePolling: true,
        },
    },
});
