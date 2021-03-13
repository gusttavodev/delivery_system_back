const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    purge: [
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue"
    ],
    theme: {
        screens: {
            'lt': '360px',
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
        },
        extend: {
            textColor: {
                'content-color': "var(--text-color)",
                'title-color': "var(--title-text-color)",
                'title-hover-color': "var(--title-text-hover-color)",

                'button-text': "var(--button-text-color)",

                'card-text': "var(--card-text-color)",
                'price-text': "var(--card-price-color)",
            },
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans]
            },
            colors: {
                'personal-colors': {
                    'primary': "var(--primary-color)",
                    'secondary': "var(--primary-color)",
                    'background': "var(--background-color)",

                    'button-background': "var(--button-background-color)",
                    'button-hover': "var(--button-hover-color)",
                    'button-count': "var(--button-count-color)",
                    'card-background': "var(--card-background-color)",
                },
                transparent: "transparent",
                current: "currentColor",
                app_blue: {
                    50:  "#f4fbff",
                    100: "#e9f8ff",
                    200: "#c7edff",
                    300: "#a5e2ff",
                    400: "#62ccff",
                    500: "#1fb6ff",
                    600: "#1ca4e6",
                    700: "#1789bf",
                    800: "#136d99",
                    900: "#0f597d",

                },
                'app_dark_blue': {
                    '50': '#FFFFFF',
                    '100': '#FFFFFF',
                    '200': '#EDEFFC',
                    '300': '#C0CAF6',
                    '400': '#93A4F0',
                    '500': '#667EEA',
                    '600': '#3958E4',
                    '700': '#1C3DCE',
                    '800': '#162FA1',
                    '900': '#102274'
                },
            }
        }
    },
    variants: {
        opacity: ["responsive", "hover", "focus", "disabled"]
    },

    plugins: [require("@tailwindcss/ui")]
};
