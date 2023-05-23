/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors:{
                "primary-color": "#4b4fbe",
                "dark-primary-color": "#3a3d92",
            },
        },
    },
    plugins: [],
};
