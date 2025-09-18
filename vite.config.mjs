import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import { resolve } from 'path'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/src/main.js'],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: { base: null, includeAbsolute: false },
      },
    }),
  ],
  define: {
    global: 'globalThis',
  },
  resolve: {
    alias: {
      '@': resolve(__dirname, 'resources/js/src'),
      '@themeConfig': resolve(__dirname, 'resources/js/theme.config.js'),
      '~nouislider/distribute/nouislider.min.css': resolve(
        __dirname,
        'node_modules/nouislider/dist/nouislider.min.css',
      ),
    },
  },
  css: {
    preprocessorOptions: {
      scss: {
        api: 'modern-compiler',
        silenceDeprecations: ['import', 'global-builtin', 'legacy-js-api'],
        includePaths: ['node_modules', 'resources/js/src/assets'],
      },
    },
  },
  build: {
    sourcemap: false, //habilitar para produção
    minify: true, //habilitar para produção
    chunkSizeWarningLimit: 1000,
    emptyOutDir: false,
    rollupOptions: {
      output: {
        manualChunks: (id) => {
          if (id.includes('node_modules/vue/') || id.includes('node_modules/@vue/')) return 'vue'
          if (id.includes('node_modules/axios/')) return 'axios'
        },
      },
    },
    commonjsOptions: {
      include: [/node_modules/],
      transformMixedEsModules: true,
      requireReturnsDefault: 'preferred',
      // 👇 Ensina explicitamente os named-exports do qs
      namedExports: {
        [resolve(__dirname, 'node_modules/qs/lib/index.js')]: ['parse', 'stringify'],
        [resolve(__dirname, 'node_modules/ziggy-js/node_modules/qs/lib/index.js')]: [
          'parse',
          'stringify',
        ],
      },
    },
  },
  optimizeDeps: {
    include: ['lodash', 'nouislider', 'qs'], // opcional, ajuda no dev
  },
  esbuild: {
    minifyIdentifiers: true, //habilitar para evitar problemas com injeção de dependência
    keepNames: false, //desabilitar para evitar problemas com injeção de dependência
  },
  server: {
    host: '0.0.0.0',
    port: 5173,
    hmr: { host: 'localhost', port: 5173 },
    watch: { usePolling: true },
  },
})
