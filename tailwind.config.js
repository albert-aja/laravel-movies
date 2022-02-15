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
    },
    plugins: [],
};
