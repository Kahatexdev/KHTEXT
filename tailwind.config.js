import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                info: {
                    50: '#eef8ff',
                    100: '#d5eaff',
                    200: '#add6ff',
                    300: '#84c0ff',
                    400: '#5baaff',
                    500: '#3394ff',
                    600: '#0e7cff',
                    700: '#0065e6',
                    800: '#0050b4',
                    900: '#003d84',
                },
                primary: {
                    50: '#f0f5ff',
                    100: '#d9e6ff',
                    200: '#b3cfff',
                    300: '#8cb8ff',
                    400: '#669fff',
                    500: '#3f86ff',
                    600: '#1a6dff',
                    700: '#0054e6',
                    800: '#0042b4',
                    900: '#003084',
                },
                secondary: {
                    50: '#f9f5ff',
                    100: '#f0e6ff',
                    200: '#e6cfff',
                    300: '#ddb8ff',
                    400: '#d49fff',
                    500: '#cb86ff',
                    600: '#c06dff',
                    700: '#b054e6',
                    800: '#a042b4',
                    900: '#8f3084',
                },
                success: {
                    50: '#f0fff5',
                    100: '#d9ffe6',
                    200: '#b3ffcc',
                    300: '#8cffb3',
                    400: '#66ff99',
                    500: '#3fff80',
                    600: '#1aff66',
                    700: '#00e64d',
                    800: '#00b433',
                    900: '#00801a',
                },
                warning: {
                    50: '#fff8f0',
                    100: '#ffe6d9',
                    200: '#ffccb3',
                    300: '#ffb38c',
                    400: '#ff9f66',
                    500: '#ff8066',
                    600: '#ff661a',
                    700: '#e64d00',
                    800: '#b43300',
                    900: '#801a00',
                },
                danger: {
                    50: '#fff0f0',
                    100: '#ffe6e6',
                    200: '#ffcccc',
                    300: '#ffb3b3',
                    400: '#ff9999',
                    500: '#ff8080',
                    600: '#ff6666',
                    700: '#e64d4d',
                    800: '#b43333',
                    900: '#801a1a',
                },
                dark: {
                    50: '#f0f0f0',
                    100: '#d9d9d9',
                    200: '#b3b3b3',
                    300: '#8c8c8c',
                    400: '#666666',
                    500: '#404040',
                    600: '#1a1a1a',
                    700: '#000000',
                    800: '#000000',
                    900: '#000000',
                },
            },
            boxShadow: {
                'soft-xl': '0 5px 15px rgba(0,0,0,0.1)',
                'soft-3xl': '0 10px 25px rgba(0,0,0,0.1)',
            },
            borderRadius: {
                '2xl': '1rem',
                '3xl': '1.5rem',
              },
        },
    },

    safelist: [
        'bg-gradient-to-r',
        'from-cyan-400', 'to-blue-500',
        'from-info-400', 'to-info-600', // contoh yang benar
      ],

    plugins: [forms],
};
