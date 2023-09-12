let mix = require('laravel-mix');

require('mix-tailwindcss');

mix.sass('assets/src/scss/styles.scss', 'assets/dist/css/styles.min.css').tailwind();
mix.js(['assets/src/js/scripts.js', 'assets/src/js/news.js', 'assets/src/js/ajax.js'], 'assets/dist/js/scripts.min.js');
    // .copy('node_modules/slick-carousel/slick/slick.css', 'dist/css/styles.min.css') // Copy Slick CSS to the 'dist' directory
    // .copy('node_modules/slick-carousel/slick/slick-theme.css', 'dist/css/styles.min.css') // Copy Slick Theme CSS to the 'dist' directory
    // .copy('node_modules/slick-carousel/slick/slick.min.js', 'dist/js/scripts.min.js')
    // .copy('node_modules/slick-carousel/slick/slick.js', 'dist/js/scripts.min.js')
    // .copy('node_modules/slick-carousel/slick/fonts', 'dist/fonts/') // Copy Slick fonts to the 'dist/fonts' directory (optional, only needed if you use Slick arrows)
    // .copy('node_modules/slick-carousel/slick/ajax-loader.gif', 'dist/images'); // Copy Slick images to the 'dist/img' directory (optional, only needed if you use Slick arrows)