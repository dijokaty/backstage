const gulp = require('gulp');
const {src, dest, parallel} = gulp;
const sass = require('gulp-sass');

const sassSrc = './publicSrc/sass/';
const jsSrc = './publicSrc/js/';

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

gulp.task('js:vendor', () => {
    return src([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        'node_modules/nette.ajax.js/nette.ajax.js',
    ])
        .pipe(dest('www/vendor/js/'));
});
gulp.task('js:dist', () => {
    return src([
        jsSrc + '**/*.js',
        jsSrc + '*.js',
    ])
        .pipe(dest('www/dist/js'));
});
gulp.task('js', () => {
    return gulp.task('js:vendor')
        .then(() => gulp.task('js:dist'));
});

gulp.task('js:watch', () => {
    gulp.watch([
        jsSrc + '**/*.js',
        jsSrc + '*.js',
    ], gulp.task('js:dist'));
});

gulp.task('build', parallel(['sass', 'js']));

