const path = require( 'path' );
const ConversionOutlineJsonPlugin = require( './webpack/config/plugins/conversion-outline-json-plugin' );

module.exports = {
	context: __dirname,
	entry: {
		bundle: './src/index.jsx',
	},
	externals: {
		react: [ 'vendor', 'React' ],
		lodash: 'lodash',
		'react-dom': [ 'vendor', 'ReactDOM' ],
		'@divi/rest': [ 'divi', 'rest' ],
	},
	module: {
		rules: [
			{
				test: /\.jsx?$/,
				exclude: /node_modules/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							compact: false,
							presets: [
								[
									'@babel/preset-env',
									{
										modules: false,
										targets: '> 5%',
									},
								],
								'@babel/preset-react',
							],
							cacheDirectory: false,
						},
					},
				],
			},
		],
	},
	resolve: {
		extensions: [ '.js', '.jsx', '.json' ],
	},
	output: {
		filename: 'mphb-divi-d5.js',
		path: path.resolve( __dirname, 'build' ),
	},
	plugins: [ new ConversionOutlineJsonPlugin() ],
	stats: {
		errorDetails: true,
	},
};
