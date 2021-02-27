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
            // => @media (min-width: 640px) { ... }

            'md': '768px',
            // => @media (min-width: 768px) { ... }

            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }

            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }
        },
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans]
            },
            colors: {
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
