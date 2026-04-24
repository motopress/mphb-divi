import metadata from './module.json';
import conversionOutline from './conversion-outline';
import React, { useMemo } from 'react';
import {
	applyAccommodationTypeField,
	cloneGroupConfiguration,
	useAccommodationTypeOptions,
} from '../../shared/accommodation-type-settings-content';
import {
	applyImageSizeField,
	useImageSizeOptions,
} from '../../shared/image-size-settings-content';
import Render from './dynamic-render';

const ModuleGroups = window.divi.module.ModuleGroups;

export { metadata };

const AccommodationFeaturedImageSettingsContent = ( {
	groupConfiguration,
} ) => {
	const typeState = useAccommodationTypeOptions( true );
	const imageSizeState = useImageSizeOptions();

	const groups = useMemo( () => {
		const nextGroups = cloneGroupConfiguration( groupConfiguration );

		applyAccommodationTypeField( {
			groups: nextGroups,
			fieldName: 'shortcodeAdvancedAccommodation_id',
			options: typeState.options,
		} );
		applyImageSizeField( {
			groups: nextGroups,
			fieldName: 'shortcodeAdvancedImage_size',
			options: imageSizeState.options,
		} );

		return nextGroups;
	}, [ groupConfiguration, imageSizeState.options, typeState.options ] );

	return <ModuleGroups groups={ groups } />;
};

export default {
	metadata,
	conversionOutline,
	settings: {
		content: AccommodationFeaturedImageSettingsContent,
	},
	previewRender: Render,
};
