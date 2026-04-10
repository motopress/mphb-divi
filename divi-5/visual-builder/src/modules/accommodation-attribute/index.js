import metadata from './module.json';
import conversionOutline from './conversion-outline';
import React, { useMemo } from 'react';
import {
	applyAccommodationTypeField,
	cloneGroupConfiguration,
	useAccommodationTypeOptions,
} from '../../shared/accommodation-type-settings-content';
import {
	applyAccommodationAttributeField,
	useAccommodationAttributeOptions,
} from '../../shared/accommodation-attribute-settings-content';
import Render from './dynamic-render';

const ModuleGroups = window.divi.module.ModuleGroups;

export { metadata };

const AccommodationAttributeSettingsContent = ( { groupConfiguration } ) => {
	const typeState = useAccommodationTypeOptions( true );
	const attributeState = useAccommodationAttributeOptions();

	const groups = useMemo( () => {
		const nextGroups = cloneGroupConfiguration( groupConfiguration );

		applyAccommodationTypeField( {
			groups: nextGroups,
			fieldName: 'shortcodeAdvancedAccommodation_id',
			options: typeState.options,
		} );

		applyAccommodationAttributeField( {
			groups: nextGroups,
			fieldName: 'shortcodeAdvancedSelected_attribute',
			mode: 'single',
			selectOptions: attributeState.selectOptions,
			checkboxOptions: attributeState.checkboxOptions,
		} );

		return nextGroups;
	}, [ attributeState, groupConfiguration, typeState ] );

	return <ModuleGroups groups={ groups } />;
};

export default {
	metadata,
	conversionOutline,
	settings: {
		content: AccommodationAttributeSettingsContent,
	},
	previewRender: Render,
};
