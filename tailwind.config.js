module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            width: {
                96: "24rem",
            },
        },
        screens: {
            sm: "540px",
            md: "720px",
            lg: "960px",
            xl: "1140px",
            "2xl": "1320px",
        },
        spinner: (theme) => ({
            default: {
                color: "#dae1e7", // color you want to make the spinner
                size: "1em", // size of the spinner (used for both width and height)
                border: "2px", // border-width of the spinner (shouldn't be bigger than half the spinner's size)
                speed: "500ms", // the speed at which the spinner should rotate
            },
            // md: {
            //   color: theme('colors.red.500', 'red'),
            //   size: '2em',
            //   border: '2px',
            //   speed: '500ms',
            // },
        }),
    },
    variants: {
        spinner: ["responsive"],
    },
    plugins: [
        require("tailwindcss-spinner")({
            className: "spinner",
            themeKey: "spinner",
        }),
    ],
};
