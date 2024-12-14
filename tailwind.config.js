import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "cod-gray": {
                    50: "#f6f5f5",
                    100: "#e8e5e5",
                    200: "#d4cecd",
                    300: "#b6acaa",
                    400: "#908380",
                    500: "#756865",
                    600: "#645a56",
                    700: "#544d4a",
                    800: "#494341",
                    900: "#403b39",
                    950: "#191716",
                },
                "tulip-tree": {
                    50: "#fcf8ea",
                    100: "#f9f0c8",
                    200: "#f4df94",
                    300: "#edc657",
                    400: "#e6af2e",
                    500: "#d6971c",
                    600: "#b87416",
                    700: "#935315",
                    800: "#7a4219",
                    900: "#68371b",
                    950: "#3d1c0b",
                },
                "gray-nurse": {
                    50: "#f7f7f5",
                    100: "#ebece8",
                    200: "#e0e2db",
                    300: "#bcc0b1",
                    400: "#a2a691",
                    500: "#90947b",
                    600: "#85876f",
                    700: "#70715d",
                    800: "#5d5c4f",
                    900: "#4d4d41",
                    950: "#282722",
                },
                
            },
        },
    },
    plugins: [],
};
