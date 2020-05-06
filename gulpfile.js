
// gulpプラグインの読み込み
const { src, dest, watch, parallel } = require( 'gulp' );

// Sassをコンパイルするプラグインの読み込み
const sass = require( 'gulp-sass' );

// ベンダープレフィックスプラグインの読み込み
const autoprefixer = require( 'gulp-autoprefixer' );

// 画像を圧縮するプラグインの読み込み
const imagemin = require( 'gulp-imagemin' );
const mozjpeg = require( 'imagemin-mozjpeg' );
const pngquant = require( 'imagemin-pngquant' );
const changed = require( 'gulp-changed' );


//画像の圧縮
const compressImage = () =>
	src( './src/img/*.{jpg,jpeg,png,gif,svg}' )
	.pipe( changed( './assets/img' ) ) //比較して異なるものだけ圧縮する
	.pipe( imagemin( [
		pngquant( { quality: [ 0.65, 0.8 ], speed: 1 } ),
		mozjpeg( { quality: 85, progressive: true } ),
		imagemin.svgo( { plugins: [ { removeViewBox: false } ] } ), //viewboxの記述を削除しない for IE
		imagemin.gifsicle()
	]))
	.pipe( dest( './assets/img' ) );

// sassをコンパイル
const compileSass = () =>
	src( './src/sass/*.scss' )// style.scssファイルを取得
	.pipe( sass( { outputStyle: 'compressed' } ) )// コンパイル後のCSSを展開
	.pipe( autoprefixer( { cascade: false } ) )
	.pipe( dest( './assets/css' ) );// cssフォルダー以下に保存


// 監視
const watchSassFiles = () => watch( './src/sass/*.scss', compileSass );
const watchImageFiles = () => watch( './src/img', compressImage );

// npx gulpコマンドで実行
exports.default = parallel( watchSassFiles, watchImageFiles );
