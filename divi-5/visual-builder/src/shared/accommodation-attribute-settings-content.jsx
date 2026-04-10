import React from 'react';
import { set } from 'lodash';

const diviPackages = window && window.divi ? window.divi : {};
const diviModule = diviPackages.module ? diviPackages.module : {};
const ModuleGroups = diviModule.ModuleGroups;
const builderData =
	window && window.MphbDiviD5VisualBuilderData
		? window.MphbDiviD5VisualBuilderData
		: {};

const buildAttributeSelectOptions = ( items ) => {
	const options = {};

	items.forEach( ( item ) => {
		if ( ! item?.slug ) {
			return;
		}

		options[ item.slug ] = {
			label: item.title || item.slug,
		};
	} );

	return options;
};

const buildAttributeCheckboxOptions = ( items ) =>
	items
		.filter( ( item ) => item?.slug )
		.map( ( item ) => ( {
			label: item.title || item.slug,
			value: item.slug,
		} ) );

const getAccommodationAttributeItems = () => {
	return Array.isArray( builderData.accommodationAttributes )
		? builderData.accommodationAttributes
		: [];
};

export const useAccommodationAttributeOptions = () => {
	const items = getAccommodationAttributeItems();
	const selectOptions = buildAttributeSelectOptions( items );
	const checkboxOptions = buildAttributeCheckboxOptions( items );

	return {
		selectOptions,
		checkboxOptions,
	};
};

export const applyAccommodationAttributeField = ( {
	groups,
	fieldName,
	mode = 'multiple',
	selectOptions,
	checkboxOptions,
} ) => {
	if ( 'multiple' === mode ) {
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
			checkboxOptions
		);
		set(
			groups,
			[
				'contentOptions',
				'component',
				'props',
				'fields',
				fieldName,
				'defaultAttr',
				'desktop',
				'value',
			],
			checkboxOptions.map( ( { value } ) => value )
		);

		return groups;
	}

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
		selectOptions
	);

	return groups;
};

export const AccommodationAttributeSettingsContent = ( {
	groupConfiguration,
	fieldName,
	mode = 'multiple',
} ) => {
	const { selectOptions, checkboxOptions } =
		useAccommodationAttributeOptions();
	const groups = JSON.parse( JSON.stringify( groupConfiguration || {} ) );

	applyAccommodationAttributeField( {
		groups,
		fieldName,
		mode,
		selectOptions,
		checkboxOptions,
	} );

	return <ModuleGroups groups={ groups } />;
};
