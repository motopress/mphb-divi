const fs = require( 'fs' );
const path = require( 'path' );
const extractStaticProperties = require( './extract-static-properties' );

const COMMENT = '!!! THIS IS AN AUTOMATICALLY GENERATED FILE - DO NOT EDIT !!!';

const getOutlineFiles = ( directory ) => {
	const entries = fs.readdirSync( directory, { withFileTypes: true } );

	return entries.flatMap( ( entry ) => {
		const absolutePath = path.join( directory, entry.name );

		if ( entry.isDirectory() ) {
			return getOutlineFiles( absolutePath );
		}

		return /^conversion-outline\.(js|ts)$/.test( entry.name )
			? [ absolutePath ]
			: [];
	} );
};

class ConversionOutlineJsonPlugin {
	apply( compiler ) {
		compiler.hooks.beforeRun.tap( 'ConversionOutlineJsonPlugin', () => {
			this.generateJsonFiles( compiler.context );
		} );

		compiler.hooks.watchRun.tap( 'ConversionOutlineJsonPlugin', () => {
			this.generateJsonFiles( compiler.context );
		} );
	}

	generateJsonFiles( context ) {
		const modulesDirectory = path.join( context, 'src', 'modules' );

		if ( ! fs.existsSync( modulesDirectory ) ) {
			return;
		}

		getOutlineFiles( modulesDirectory ).forEach( ( filePath ) => {
			const source = fs.readFileSync( filePath, 'utf8' );
			const outline = extractStaticProperties( source );
			const jsonPath = filePath.replace( /\.(js|ts)$/, '.json' );
			const output = JSON.stringify(
				{
					_comment: COMMENT,
					...outline,
				},
				null,
				'\t'
			);

			fs.writeFileSync( jsonPath, `${ output }\n` );
		} );
	}
}

module.exports = ConversionOutlineJsonPlugin;
