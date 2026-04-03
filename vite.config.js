import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig(({ mode }) => {
    // Membaca file .env secara otomatis
    const env = loadEnv(mode, process.cwd(), '');

    // Mengambil hostname dari APP_URL
    const host = env.APP_URL ? new URL(env.APP_URL).hostname : 'localhost';

    return {
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                    'resources/css/admin.css',
                ],
                refresh: true,
            }),
        ],
        server: {
            host: '0.0.0.0', // Membuka akses jaringan
            hmr: {
                host: host, // Mengikuti APP_URL di .env secara otomatis
            },
        },
    }
})
