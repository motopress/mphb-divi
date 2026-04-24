import { set } from 'lodash';

const builderData =
	window && window.MphbDiviD5VisualBuilderData
		? window.MphbDiviD5VisualBuilderData
		: {};

const getImageSizeOptions = () => {
	if (
		builderData.imageSizes &&
		'object' === typeof builderData.imageSizes &&
		! Array.isArray( builderData.imageSizes )
	) {
		return Object.entries( builderData.imageSizes ).reduce(
			( options, [ value, label ] ) => {
				if ( ! value ) {
					return options;
				}

				options[ value ] = {
					label: label || value,
				};

				return options;
			},
			{}
		);
	}

	return {};
};

export const useImageSizeOptions = () => ( {
	options: getImageSizeOptions(),
} );

export const applyImageSizeField = ( { groups, fieldName, options } ) => {
	set(
		groups,
		[
			'contentOptions',
			'component',
			'props',
			'fields',
			fieldName,
			'options',
		],
		options
	);
};
