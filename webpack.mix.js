let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js/')
  .sass('resources/assets/sass/app.scss', 'public/css/')
  .copy('resources/assets/img/', 'public/img/')
  .styles([
    'resources/assets/css/app.css',
    './node_modules/ionicons/dist/css/ionicons.min.css',
    './node_modules/font-awesome/css/font-awesome.min.css',
    './node_modules/admin-lte/dist/css/AdminLTE.min.css',
    './node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
    './node_modules/icheck/skins/square/blue.css',
    './node_modules/toastr/build/toastr.min.css'
  ], 'public/css/nhcrm.css')
  //.copy('./node_modules/admin-lte/plugins/', 'public/plugins')
  .copy([
    './node_modules/icheck/skins/square/blue.png',
    './node_modules/icheck/skins/square/blue@2x.png'
  ], 'public/css/')
  .copy(['./node_modules/admin-lte/dist/img/'], 'public/img/')
  .copy('./node_modules/icheck/skins/square/blue@2x.png', 'public/css/')
  .copy([
    './node_modules/font-awesome/fonts/*.*',
    './node_modules/ionicons/dist/fonts/*.*',
    './node_modules/bootstrap-sass/assets/fonts/bootstrap/*.*'
  ], 'public/fonts/')
  .sourceMaps();