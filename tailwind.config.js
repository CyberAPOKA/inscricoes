import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
            },
            colors: {
                'dark': '#191919',
                'yellow': '#FFEC00',
                'green': '#0DCD71',
                'green-info': '#8EFEB4',
                'gray-card': '#9F9F9F',
                'gray-button': '#9F9F9F',
            },
            boxShadow: {
                'all': "0 0 5px 2px #dfdddd",
                'all-green': "0 0 15px 2px #0DCD71",
                'input': "0px 0px 8px 0px rgba(0, 0, 0, 0.20)",
                'xt': "-5px 0 5px -5px rgba(0, 0, 0, 0.3), 0 -5px 5px -5px rgba(0, 0, 0, 0.3), 5px 0 5px -5px rgba(0, 0, 0, 0.3);",
                'tl': "-5px 0 5px -5px rgba(0, 0, 0, 0.3), 0 -5px 5px -5px rgba(0, 0, 0, 0.3), 5px 0 5px -5px rgba(0, 0, 0, 0.3);",
            },
            backgroundImage: {
                'grad-gray': 'linear-gradient(180deg, #9F9F9F 0%, #797979 100%)',
                'grad-green': 'linear-gradient(180deg, #0DCD71 9.09%, #008847 100%)',
                'all-100': "0 0 5px 0px #dfdddd",
                'all-200': "0 0 5px 5px #c5c2c2",
            },
        },
    },

    plugins: [forms, typography],
};
