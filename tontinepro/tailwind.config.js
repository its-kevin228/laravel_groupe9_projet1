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
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
                montserrat: ['Montserrat', 'sans-serif'],
                gelion: ['Gelion', 'sans-serif'],
            },
            colors: {
                sage: {
                    dark: '#a8be90',
                    light: '#d7e6c5',
                    dim: '#636c59',
                },
                tixtogo: {
                    green: '#6AC045',
                    bg: '#F5F7F9',
                    alt: '#F1F2F3',
                    success: '#E8F7F7',
                    border: '#F1F1F1',
                    muted: '#717171',
                },
                mint: '#fbfcf7',
                'white-smoke': '#f5f5f5',
            },
            borderRadius: {
                'tix': '5px',
            }
        },
    },

    plugins: [forms],
};
