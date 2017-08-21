var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync'),
    cssnano = require('gulp-cssnano'),
    autoprefixer = require('gulp-autoprefixer'),
    imagemin = require('gulp-imagemin'),
    clean = require('del');

var config = {
    'php': {
        'src': './**/*.php'
    },
    'sass': {
        'src': './sass/**/*.scss',
        'dest': './'
    },
    'js': {
        'src': './js/**/*.js',
        'dest': './js/'
    },
    'img': {
        'src': './images/*',
        'dest': './images/'
    }
};

gulp.task('php', function () {
    return gulp.src(config.php.src)
        .pipe(browserSync.reload({
            stream: true
        }));
});

gulp.task('sass', function () {
    gulp.src(config.sass.src)
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: '> 5%',
            cascade: true
        }))
        .pipe(gulp.dest(config.sass.dest))
        .pipe(browserSync.reload({
            stream: true
        }));
});

gulp.task('js', function () {
    return gulp.src(config.js.src)
        .pipe(browserSync.reload({
            stream: true
        }))
        .pipe(gulp.dest(config.js.dest))
});

gulp.task('minify:img', function () {
    return gulp.src(config.img.src)
        .pipe(imagemin())
        .pipe(gulp.dest(config.img.dest));
});

gulp.task('browser-sync', function () {
    browserSync.init({
        notify: false,
        proxy: "localhost/business_plus/"
    });
});


gulp.task('watch', ['browser-sync', 'php', 'sass', 'js'], function () {
    gulp.watch(config.php.src, ['php']);
    gulp.watch(config.sass.src, ['sass']);
    gulp.watch(config.js.src, ['js']);
});


