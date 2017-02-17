var gulp = require('gulp'),
    gcb = require('gulp-callback'),
    fs = require('fs-extra'),
    less = require('gulp-less'),
    minifyCSS = require('gulp-minify-css'),
    uglifyJS = require('gulp-uglifyjs'),
    rand = Math.floor(Math.random()*1000001);

gulp.task('build', function() {

    gulp.src('./css/style.less')
    .pipe(less())
    .pipe(minifyCSS())
    .pipe(gulp.dest('./css'))
    .pipe(gcb(function(){
        fs.readdir('./tmpl', function(rddirErr, files){
            if (rddirErr) {
                console.log(rddirErr);
                return;
            }

            fs.createReadStream('config.js').pipe(fs.createWriteStream('mobi.js'));

            fs.readFile('./config.js', 'utf8', function(confErr, conf){
                if (confErr) {
                    console.log(confErr);
                    return;
                }
                for (var i in files) {
                    var data = fs.readFileSync('./tmpl/' + files[i], 'utf8');
                    if (!data) {
                        console.log("Not found " + files[i]);
                    } else {
                        console.log("Found " + files[i]);
                        var html = data.replace(/[\r\n]/g, '').replace(/>[\t\s]*</g, '><').replace(/'/g, '\'+"\'"+\'').replace(/\{rand}/gi, rand);
                        conf = conf.replace('./tmpl/' + files[i], html);
                    }
                }
                fs.writeFile('./mobi.js', conf, function(wrErr){
                    if (wrErr) {
                        console.log(wrErr);
                        return;
                    }
                    fs.mkdir('./build', function(e){
                        if (!e || (e && e.code === 'EEXIST')){
                            fs.copySync('./css', './build/css');
                            fs.copySync('./img', './build/img');
                            fs.copySync('./js', './build/js');
                            fs.copySync('./eski.mobi.min.js', './build/eski.mobi.min.js');
                            fs.copySync('./mobi.js', './build/mobi.js');
                            fs.readFile('./build/mobi.js', 'utf8', function(mobiErr, mobi){
                                if (mobiErr) {
                                    console.log(mobiErr);
                                    return;
                                }
                                fs.writeFile('./build/mobi.js', mobi.replace(/optimization:/, 'root:"/eskimobi/build",optimization:').replace(/mode:\s*"(production|development|off)"/, 'mode: "local"'), function(wrMobiErr){
                                    if (wrMobiErr) {
                                        console.log(wrMobiErr);
                                        return;
                                    }
                                    gulp.src('./build/mobi.js')
                                        .pipe(uglifyJS())
                                        .pipe(gulp.dest('./build/'))
                                        .pipe(gcb(function(){
                                            console.log("Build success!");
                                        }));
                                });
                            });
                        } else {
                            console.log(e);
                            return;
                        }
                    });
                });
            });
        });
    }));
});
