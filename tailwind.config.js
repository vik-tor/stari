/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.svelte",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],
    daisyui: {
        styled: true,
        themes: false,
        base: true,
        utils: true,
        logs: true,
        rtl: false,
        prefix: "",
        themes: [
            {
                light: {
                    primary: "#efefef",
                    secondary: "#cdcdcd",
                    accent: "#f62a00",
                    neutral: "#ffffff",
                    "base-100": "#f5fbff",
                    info: "#2891E6",
                    success: "#178254",
                    warning: "#D47A0C",
                    error: "#E03862",
                },
                dark: {
                    primary: "#282828",
                    secondary: "#3c3836",
                    accent: "#A31B00",
                    neutral: "#1d2021",
                    "base-100": "#f1f3ce",
                    info: "#2891E6",
                    success: "#178254",
                    warning: "#D47A0C",
                    error: "#E03862",
                },
                /* dark: {
              "primary": "#00293C",
              "secondary": "#1e656d",
              "accent": "#A31B00",
              "neutral": "#001C29",
              "base-100": "#f1f3ce",
              "info": "#2891E6",
              "success": "#178254",
              "warning": "#D47A0C",
              "error": "#E03862",
            }, */
            },
        ],
    },
};
