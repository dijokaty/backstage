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
    return src([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    ])
        .pipe(dest('www/vendor/js/'));
});
gulp.task('build', parallel(['sass', 'js']));

