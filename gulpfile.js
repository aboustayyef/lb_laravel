var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('styles',function(){
    gulp.src('./app/resources/scss/lebaneseblogs.scss')
    .pipe(sourcemaps.init())
//    .pipe(rename('testinggulp.scss'))
    .pipe(sass({
        outputStyle: 'compressed'
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./public/css/'))
});

gulp.task('scripts', function(){
    gulp.src([  './app/resources/js/third_party/jquery-1.11.0.min.js',
                // './app/resources/js/third_party/masonry.pkgd.min.js',
                './app/resources/js/lb.sources/lb.events.js',
                // './app/resources/js/lb.sources/lb.favorites.js',
                './app/resources/js/lb.sources/lb.functions.js',
                './app/resources/js/lb.sources/lb.menus.js',
                './app/resources/js/lb.sources/lb.preparefonts.js',
                // './app/resources/js/lb.sources/lb.saved.js',
                // './app/resources/js/lb.sources/lb.toplist.js' ,
                // './app/resources/js/lb.sources/lb.showPost.js',
                './app/resources/js/lb.sources/lb.toggleChannels.js'
                ])
    .pipe(concat('lebaneseblogs.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./public/js'));
});

gulp.task('default', ['scripts','styles']);