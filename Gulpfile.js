var gulp         = require('gulp'),
    less         = require('gulp-less'),
    plumber      = require('gulp-plumber'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps   = require('gulp-sourcemaps'),
    livereload   = require('gulp-livereload'),
    notify       = require('gulp-notify'),
    minifyCSS    = require('gulp-minify-css');
 
plumberOptions = {errorHandler: notify.onError({title: "<%= error.message %>", message: "line <%= error.lineNumber %> in <%= error.fileName %>"})};

gulp.task('css', function () {
    var destination = './';
    gulp.src('./dev/style.less')
        .pipe(plumber(plumberOptions))
        .pipe(sourcemaps.init())
            .pipe(less())
            .pipe(autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(destination))
        .pipe(livereload())
        .pipe(minifyCSS())
        .pipe(gulp.dest(destination));
});

gulp.task('watch', function(){
    gulp.watch(['./dev/style.less'], ['css']);

    // Create LiveReload server
    livereload.listen();
});

gulp.task('default', ['watch']);