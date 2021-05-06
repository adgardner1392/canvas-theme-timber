let mix = require("laravel-mix");
mix
    .js([
        "node_modules/aos/dist/aos.js",
        "assets/src/js/app.js"
    ] , "assets/dist/app.js")
    .sass("assets/src/scss/app.scss", "assets/dist/")
    .sass("assets/src/scss/gutenberg.scss", "assets/dist/")
    .copyDirectory("assets/src/fonts", "assets/dist/fonts")
    .copyDirectory("assets/src/vectors", "assets/dist/vectors")
    .browserSync({
        proxy: "canvas-timber.site",
        files: [
            "./assets/dist/*",
            "./assets/src/js/**/*.js",
            "./assets/src/scss/**/*.scss",
            "./assets/src/img/**/*.+(png|jpg|svg)",
            "./**/*.+(html|php)",
            "./views/**/*.+(html|twig)",
            "./assets/src/fonts/*"
        ]
    });
