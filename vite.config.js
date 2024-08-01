import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.js'],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      jquery: 'jquery/dist/jquery.min.js',
      lodash: 'lodash/lodash.min.js',
      'popper.js': 'popper.js/dist/umd/popper.min.js',
      bootstrap: 'bootstrap/dist/js/bootstrap.bundle.min.js',
    },
  },
});
