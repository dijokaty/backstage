const gulp = require('gulp');
const {src, dest, parallel} = gulp;
const sass = require('gulp-sass');

const sassSrc = './publicSrc/sass/';

gulp.task('sass', () => {
    return src(sassSrc + '**/*.scss')
        .pipe(sass())
        .pipe(dest('./www/dist/css/'));
});

gulp.task('sass:watch', () => {
    gulp.watch([
        sassSrc + '**/*.scss',
        sassSrc + '*.scss',
    ], gulp.task('sass'));
});

gulp.task('js', () => {
    let vendor = src([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        'node_modules/nette.ajax.js/nette.ajax.js',
    ])
        .pipe(dest('www/vendor/js/'));
    let dist = src([
        'publicSrc/js/nette.alert.js'
    ])
        .pipe(dest('www/dist/js'));

    return Promise.all([vendor, dist])
});
gulp.task('build', parallel(['sass', 'js']));

