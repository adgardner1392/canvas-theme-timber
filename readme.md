### Setup Theme

First, please make sure you have installed node.js, npm and composer on your system. Then lets initialise composer so that it can autoload Timber library.

```html
composer init -n \
--name=canvas-theme-timber \
--type=wordpress-theme \
--license=MIT \
--require="timber/timber *"
````

This will create your `composer.json` file with the information that you provided.

Now we will need to run a `composer install` to complete the installation of composer and the required `Timber` package within the theme. After this has completed you will see a `vendor` directory within your theme.

Next we will need to create our `package.json` file. You can do this by running the following command:

````html
npm init -y
````

Next we can install the required libraries with this single command:

```html
npm install laravel-mix aos browser-sync browser-sync-webpack-plugin --save-dev
````

### Configure Laravel Mix

The `webpack.mix.js` file has already been created for this theme, and as you can see this is setup for compiling and `Browsersync`.

You should be able to see the proxy address (update as required), and the files that are watched by `Browsersync` :

````html
.browserSync({
    proxy: "canvas-timber.site",
    files: [
        "./assets/dist/*",
        "./assets/src/js/**/*.js",
        "./assets/src/scss/**/*.scss",
        "./assets/src/img/**/*.+(png|jpg|svg)",
        "./**/*.+(html|php)",
        "./views/**/*.+(html|twig)"
    ]
});
````

The only remaining thing we must do is update the `package.json` to allow us to run our compiler.

You can do this by replacing the following:

````html
"scripts": {

"test": "echo \"Error: no test specified\" && exit 1"

},
````

With this:

````html
"scripts": {
  "dev": "NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --config=node_modules/laravel-mix/setup/webpack.config.js",  
  "watch": "NODE_ENV=development node_modules/webpack/bin/webpack.js --watch --progress --config=node_modules/laravel-mix/setup/webpack.config.js",
  "production": "NODE_ENV=production node_modules/webpack/bin/webpack.js --progress --config=node_modules/laravel-mix/setup/webpack.config.js"
},
````

Once that has been saved, we are ready to go.

### Compiling code

`npm run dev`

This will compile all scripts and other assets into the distribution folder without any optimisation

`npm run watch`

This will be the same as above, but also refresh your browser as soon as you make changes to your code.

`npm run production`

This will compile all code and other assets into the distribution folder (optimised for production usage).
