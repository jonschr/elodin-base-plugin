const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const glob = require('glob');
const fs = require('fs');

// Helper to get SCSS imports dynamically
const getSassImports = (directory) =>
	glob
		.sync(`${directory}/**/*.scss`) // Find all SCSS files
		.map(
			(file) =>
				`@use '${file
					.replace(/\\/g, '/')
					.replace('assets/css/', '')}' as *;`
		) // Use @use with proper paths
		.join('\n');

// Dynamically generate imports for `global` and `styles` folders
const globalImports = getSassImports('./assets/css/global');
const stylesImports = getSassImports('./assets/css/styles');

// Write the combined SCSS imports to `plugin-styles.scss` before every compile
fs.writeFileSync(
	'./assets/css/plugin-styles.scss',
	`${globalImports}\n${stylesImports}`
);

module.exports = {
	mode: 'development', // Use 'production' for minified output
	entry: './assets/css/plugin-styles.scss', // SCSS entry point
	output: {
		path: path.resolve(__dirname, 'dist/css'),
		filename: 'plugin-styles.js', // Dummy JS file for webpack (CSS will be extracted)
	},
	module: {
		rules: [
			{
				test: /\.scss$/, // Match all .scss files
				use: [
					MiniCssExtractPlugin.loader, // Extract CSS into files
					'css-loader', // Translates CSS into CommonJS
					{
						loader: 'sass-loader', // Compiles Sass to CSS
						options: {
							sassOptions: {
								includePaths: [
									path.resolve(__dirname, 'assets/css'),
								], // Allow absolute imports from 'assets/css'
							},
						},
					},
				],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: 'plugin-styles.css', // Output CSS file
		}),
		{
			apply: (compiler) => {
				compiler.hooks.beforeCompile.tap('InjectSassImports', () => {
					fs.writeFileSync(
						'./assets/css/plugin-styles.scss',
						`${globalImports}\n${stylesImports}` // Rebuild imports dynamically on each compile
					);
				});
			},
		},
	],
	watchOptions: {
		ignored: /node_modules|\.tmp$|\.swp$|\.DS_Store/, // Ignore irrelevant files
		aggregateTimeout: 500, // Increase delay before rebuilding (500ms)
		poll: false, // Disable polling entirely (or set a higher interval if needed)
	},
	stats: {
		all: false, // Turn off all output
		errors: true, // Show errors
		warnings: true, // Show warnings
		timings: true, // Show timing for each build
	},
};
