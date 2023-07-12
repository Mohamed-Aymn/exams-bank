/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    plugins: [
        require("daisyui")
    ],
    // corePlugins: { 
    //     preflight: false
    // },
    daisyui: {
        themes: [
                    {
                        light: {
                            "primary":  "#4b4fbe",
                            "secondary": "#d926a9",
                            "accent": "#1fb2a6",
                            "neutral": "#2a323c",
                            "base-100": "#1d232a",
                            "info": "#3abff8",
                            "success": "#36d399",
                            "warning": "#fbbd23",
                            "error": "#f87272",
                        },
                    },
                ],
    },
};
