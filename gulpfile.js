var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var watch = require('gulp-watch');

var gutil = require('gulp-util');
var source = require('vinyl-source-stream');
var browserify = require('browserify');

gulp.task('styles',function(){
    //Desktop
    gulp.src('./app/resources/scss/lebaneseblogs2.scss')
    .pipe(sass({
        outputStyle: 'compressed'
    }))
    .pipe(gulp.dest('./public/css/'));
});

gulp.task('js', function(){
	return browserify('./app/resources/js/app.js')
	.bundle()
	.on('error', function(e){
		gutil.log(e);
	})
	.pipe(source('bundle.js'))
	.pipe(gulp.dest('./public/js'))
});

gulp.task('watch', function () {
    gulp.watch('./app/resources/js/*.js', ['js']);
    gulp.watch('./app/resources/js/lbModules/*.js', ['js']);
    gulp.watch('./app/resources/scss/*.scss', ['styles']);
});

// gulp.task('styles',function(){
//     //Desktop
//     gulp.src('./public/scss/lebaneseblogs.scss')
//     .pipe(sass({
//         outputStyle: 'compressed'
//     }))
//     .pipe(gulp.dest('./public/css/'));
    
//     // Critical Desktop    
//     gulp.src('./public/scss/criticalcss.scss')
//     .pipe(sass({
//         outputStyle: 'compressed'
//     }))
//     .pipe(gulp.dest('./public/css'));

//     //Mobile
//     gulp.src('./public/scss/mobile/mobile.scss')
//     .pipe(sass({
//         outputStyle: 'compressed'
//     }))
//     .pipe(gulp.dest('./public/css/'));
// });

// gulp.task('scripts', function(){
//     gulp.src([  './public/js/third_party/jquery-1.11.0.min.js',
//                 './public/js/third_party/masonry.pkgd.min.js',
//                 './public/js/lb.sources/lb.events.js',
//                 './public/js/lb.sources/lb.favorites.js',
//                 './public/js/lb.sources/lb.functions.js',
//                 './public/js/lb.sources/lb.menus.js',
//                 './public/js/lb.sources/lb.preparefonts.js',
//                 './public/js/lb.sources/lb.saved.js',
//                 './public/js/lb.sources/lb.toplist.js' ,
//                 './public/js/lb.sources/lb.showPost.js',
//                 './public/js/lb.sources/lb.toggleChannels.js'
//                 ])
//     .pipe(concat('gulptest.js'))
//     .pipe(uglify())
//         .pipe(gulp.dest('./public/css/'))
//     .pipe(gulp.dest('./public/js'));
// });
