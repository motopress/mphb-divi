import React, { useMemo } from 'react';
import { get, set } from 'lodash';

const diviPackages = window && window.divi ? window.divi : {};
const diviModule = diviPackages.module ? diviPackages.module : {};
const ModuleGroups = diviModule.ModuleGroups;
const builderData =
	window && window.MphbDiviD5VisualBuilderData
		? window.MphbDiviD5VisualBuilderData
		: {};

export const cloneGroupConfiguration = ( groupConfiguration ) => {
	if ( ! groupConfiguration ) {
		return {};
	}

	return JSON.parse( JSON.stringify( groupConfiguration ) );
};

const normalizeDefaultAttr = ( value ) =>
	value === 'current' ? 'current' : '';

const buildAccommodationTypeOptions = ( items, allowCurrent ) => {
	const roomTypeOptions = {};

	items.forEach( ( item ) => {
		roomTypeOptions[ String( item.id ) ] = {
			label: `${ item.title || item.id } #${ item.id }`,
		};
	} );

	return allowCurrent
		? {
				current: {
					label: 'Use current',
				},
				room_types: {
					label: 'Accommodation types',
					options: roomTypeOptions,
				},
		  }
		: roomTypeOptions;
};

const getAccommodationTypeItems = () =>
	Array.isArray( builderData.accommodationTypes )
		? builderData.accommodationTypes
		: [];

export const useAccommodationTypeOptions = ( allowCurrent = true ) => {
	const options = useMemo( () => {
		return buildAccommodationTypeOptions(
			getAccommodationTypeItems(),
			allowCurrent
		);
	}, [ allowCurrent ] );

	return { options };
};

export const applyAccommodationTypeField = ( {
	groups,
	fieldName,
	options,
} ) => {
	const defaultAttr = normalizeDefaultAttr(
		get(
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
			''
		)
	);

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
		defaultAttr
	);
};

export const AccommodationTypeSettingsContent = ( {
	groupConfiguration,
	fieldNames = [],
	allowCurrent = true,
} ) => {
	const { options } = useAccommodationTypeOptions( allowCurrent );

	const preparedGroups = useMemo( () => {
		const groups = cloneGroupConfiguration( groupConfiguration );

		fieldNames.forEach( ( fieldName ) => {
			applyAccommodationTypeField( {
				groups,
				fieldName,
				options,
			} );
		} );

		return groups;
	}, [ fieldNames, groupConfiguration, options ] );

	return <ModuleGroups groups={ preparedGroups } />;
};

export const createAccommodationTypeSettings = ( fieldNames ) => ( props ) => (
	<AccommodationTypeSettingsContent { ...props } fieldNames={ fieldNames } />
);

export const createAccommodationTypeSettingsWithConfig =
	( { fieldNames, allowCurrent = true } ) =>
	( props ) => (
		<AccommodationTypeSettingsContent
			{ ...props }
			allowCurrent={ allowCurrent }
			fieldNames={ fieldNames }
		/>
	);
