const mix = require('laravel-mix');

mix
  .js('src/js/app.js', 'assets/js/')
  .extract([
    'vue',
    'bootstrap',
    'jquery',
    'mmenu-js',
    'slick-carousel',
    '@fancyapps/fancybox',
  ])
  .js('src/js/script.js', 'assets/js/')
  .sass('src/sass/app.scss', 'assets/css/')
  .sass('src/sass/tinymce.scss', 'assets/css/')
  .sass('src/sass/backend.scss', 'assets/css/');

mix.webpackConfig({
  resolve: {
    alias: {
      '@js': path.resolve(__dirname, 'src/js'),
      '@sass': path.resolve(__dirname, 'src/sass'),
    },
  },
  module: {
    rules: [
      {
        test: /\.scss/,
        loader: 'sass-loader',
        options: {
          prependData: `
            @import "@sass/_variables";
            @import "@sass/mixins/responsive";
          `,
        },
      },
    ],
  },
});

mix.config.fileLoaderDirs.fonts = '../../../';

// Disable mix-manifest.json
Mix.manifest.refresh = (_) => void 0;
