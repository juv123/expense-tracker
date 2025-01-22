import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'], // Ensure these files exist
      refresh: true,
    }),
  ],
  server: {
    host: 'localhost', // Ensure valid host
    port: 8000,        // Optional, set a valid port
  },
  build: {
    outDir: 'public/build', // Ensure correct output folder
    manifest: true,         // Ensure manifest.json is generated
  },
});
