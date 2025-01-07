import { createVinoApp } from 'vino-vue';
import { createApp } from 'vue';
import { ZiggyVue } from 'ziggy-js';

createVinoApp({
  resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true });
    return pages[`./pages/${name}.vue`];
  },
  el: document.getElementById('app')!,
  setup({ App, props, el }) {
    createApp(App, props).use(ZiggyVue).mount(el);
  },
});
