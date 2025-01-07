import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vitePluginVino from '../vino-js/packages/vite-plugin-vino/src/index';
import vuePlugin from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.ts'],
      refresh: true,
    }),
    vitePluginVino(),
    vuePlugin(),
  ],
});
