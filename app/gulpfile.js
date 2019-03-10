let gulp =  require('gulp')
    stylus = require('gulp-stylus')
    autoprefixer = require('gulp-autoprefixer')
    sourcemaps = require('gulp-sourcemaps')
    cleanCSS = require('gulp-clean-css')
    uglify = require('gulp-uglify')
    concat = require("gulp-concat")
    babel = require('gulp-babel')
    imagemin = require('gulp-imagemin')
    pngquant = require("imagemin-pngquant")
    mozjpeg = require('imagemin-mozjpeg')
    plumber = require('gulp-plumber')
    notify = require("gulp-notify")
    changed = require('gulp-changed')
    gulpif = require('gulp-if')
    yargs = require('yargs').argv;

let src = {
  'styles': ['./src/stylus/style.styl'],
  'images': ['./src/**/*.+(jpg|jpeg|png|gif|svg|ico)'],
  'js': './src/js/**/*.js',
}

let dest = {
  'root': '../'
}

let isProduction = (yargs.env === 'production') ? true : false;
let environment = (yargs.env === 'production') ? 'production' : 'development';

gulp.task('environment', (done) =>  {
  console.log('environment:'+environment);
  done();
});

let env = environment;
gulp.task('styles', () =>  {
  return gulp.src(src.styles)
    .pipe(plumber({errorHandler: notify.onError('Error: <%= error.message %>')}))
    .pipe(stylus({define:{env}}))
    .pipe(autoprefixer({
      browsers: ['last 2 version'],
      grid: true
    }))
    .pipe(gulpif(isProduction, cleanCSS()))
    .pipe(gulp.dest(dest.root))
})

gulp.task('javascript', () => {
  return gulp.src(src.js)
    .pipe(plumber({errorHandler: notify.onError('Error: <%= error.message %>')}))
    .pipe(babel())
    .pipe(gulpif(isProduction, uglify()))
    .pipe(concat('script.js'))
    .pipe(gulp.dest(dest.root))
})

gulp.task('imagemin', () => {
  return gulp.src(src.images)
    .pipe(changed(dest.root))
    .pipe(plumber({errorHandler: notify.onError('Error: <%= error.message %>')}))
    .pipe(imagemin(
      [
        pngquant({
          quality: '65-80',
          speed: 1,
          floyd:0
        }),
        // pngquantでpng画像が暗くなってしまうバグを防ぐ
        imagemin.optipng(),

        mozjpeg({
          quality:85,
          progressive: true
        }),

        imagemin.svgo(),

        imagemin.gifsicle()
      ]
    ))
    .pipe(gulp.dest(dest.root))
})

gulp.task('default', gulp.parallel(gulp.series('styles', 'javascript', 'imagemin'), () =>  {
  gulp.watch('./src/stylus/**/*.styl', gulp.series('styles'))
  gulp.watch('./src/js/**/*.js', gulp.series('javascript'))
  gulp.watch('./src/img/**/*.+(jpg|jpeg|png|gif|svg|ico)', gulp.series('imagemin'))
}))

gulp.task('build', gulp.series(gulp.parallel('styles','javascript','imagemin')))
