const mix = require('laravel-mix');
const globImporter = require('node-sass-glob-importer');

mix.sass('assets/css/pluginslug-styles.scss', 'dist/css', {
	sassOptions: {
		importer: globImporter(),
	},
});
