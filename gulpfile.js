var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('styles',function(){
    gulp.src('./public/scss/lebaneseblogs.scss')
    .pipe(sourcemaps.init())
//    .pipe(rename('testinggulp.scss'))
    .pipe(sass({
        outputStyle: 'compressed'
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./public/css/'))
});

gulp.task('scripts', function(){
    gulp.src([  './public/js/third_party/jquery-1.11.0.min.js',
                './public/js/third_party/masonry.pkgd.min.js',
                './public/js/lb.sources/lb.events.js',
                './public/js/lb.sources/lb.favorites.js',
                './public/js/lb.sources/lb.functions.js',
                './public/js/lb.sources/lb.menus.js',
                './public/js/lb.sources/lb.preparefonts.js',
                './public/js/lb.sources/lb.saved.js',
                './public/js/lb.sources/lb.toplist.js' ,
                './public/js/lb.sources/lb.showPost.js',
                './public/js/lb.sources/lb.toggleChannels.js'
                ])
    .pipe(concat('gulptest.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./public/js'));
});
