/* eslint-disable import/no-extraneous-dependencies */
const parser = require( '@babel/parser' );
const traverse = require( '@babel/traverse' ).default;

const toStaticValue = ( node ) => {
	if ( ! node ) {
		return null;
	}

	switch ( node.type ) {
		case 'ObjectExpression':
			return node.properties.reduce( ( acc, property ) => {
				if ( property.type !== 'ObjectProperty' ) {
					return acc;
				}

				let key = null;

				if ( property.key.type === 'Identifier' ) {
					key = property.key.name;
				} else if (
					property.key.type === 'StringLiteral' ||
					property.key.type === 'NumericLiteral'
				) {
					key = String( property.key.value );
				}

				if ( null !== key ) {
					acc[ key ] = toStaticValue( property.value );
				}

				return acc;
			}, {} );

		case 'ArrayExpression':
			return node.elements.map( ( element ) => toStaticValue( element ) );

		case 'StringLiteral':
		case 'NumericLiteral':
		case 'BooleanLiteral':
			return node.value;

		case 'NullLiteral':
			return null;

		case 'TemplateLiteral':
			if ( node.expressions.length > 0 ) {
				throw new Error(
					'Unsupported template literal expression in conversion outline.'
				);
			}

			return node.quasis
				.map( ( quasi ) => quasi.value.cooked )
				.join( '' );

		case 'Identifier':
			if ( 'undefined' === node.name ) {
				return null;
			}

			return node.name;

		case 'UnaryExpression':
			if ( '+' === node.operator ) {
				return +toStaticValue( node.argument );
			}

			if ( '-' === node.operator ) {
				return -toStaticValue( node.argument );
			}

			break;
	}

	throw new Error(
		`Unsupported node type in conversion outline: ${ node.type }`
	);
};

module.exports = ( source ) => {
	const ast = parser.parse( source, {
		sourceType: 'module',
		plugins: [ 'jsx', 'typescript' ],
	} );

	let extracted = null;

	traverse( ast, {
		VariableDeclarator( path ) {
			if (
				'extracted' !== path.key &&
				path.node.id &&
				'Identifier' === path.node.id.type &&
				'conversionOutline' === path.node.id.name
			) {
				extracted = toStaticValue( path.node.init );
				path.stop();
			}
		},
	} );

	if ( null === extracted ) {
		throw new Error( 'Unable to locate `conversionOutline` export.' );
	}

	return extracted;
};
