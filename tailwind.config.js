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
                sansita : ['Sansita Swashed', "system-ui"],
                anek : ['Anek Tamil', "sans-serif"]
            },
            colors : {
                background : "#FAF5F1",
                primary : "#6D3914",
                secondary : "#DFC9A0",
                tersier : "#FAF5F1",
            }
        },
    },

    plugins: [forms],
};
