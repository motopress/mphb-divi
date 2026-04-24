import React, { useEffect, useMemo, useRef } from 'react';
import { useRenderedModuleHtml } from './use-rendered-module-html';

const getAdvancedValue = ( attrs, fieldName ) => {
	return attrs &&
		attrs.shortcode &&
		attrs.shortcode.advanced &&
		attrs.shortcode.advanced[ fieldName ] &&
		attrs.shortcode.advanced[ fieldName ].desktop
		? attrs.shortcode.advanced[ fieldName ].desktop.value
		: '';
};

const normalizeSelectedValue = ( selectedValue ) => {
	if (
		! selectedValue ||
		'current' === selectedValue ||
		( 'string' === typeof selectedValue && '' === selectedValue.trim() )
	) {
		return '';
	}

	return Array.isArray( selectedValue )
		? String( selectedValue[ 0 ] || '' )
		: String( selectedValue );
};

const initializePreviewSliders = ( containerNode ) => {
	if ( ! containerNode || ! window?.MPHB?.FlexsliderGallery ) {
		return;
	}

	const sliderNodes = containerNode.querySelectorAll(
		'.mphb-flexslider-gallery-wrapper'
	);

	sliderNodes.forEach( ( sliderNode ) => {
		new window.MPHB.FlexsliderGallery( sliderNode ).initSliders();

		const roomTypeNode = sliderNode.closest( '.type-mphb_room_type' );

		if (
			roomTypeNode &&
			! roomTypeNode.dataset.mphbDiviPreviewClickBound
		) {
			roomTypeNode.addEventListener(
				'click',
				( event ) => {
					if ( event.target.closest( 'a, .button' ) ) {
						event.preventDefault();
						event.stopImmediatePropagation?.();
					}
				},
				true
			);
			roomTypeNode.dataset.mphbDiviPreviewClickBound = 'true';
		}
	} );
};

export const createRenderedModulePreview = ( {
	moduleName,
	selectionFieldName = null,
	initializeSliders = false,
} ) =>
	function RenderedModulePreview( { attrs, fallback = null } ) {
		const previewContainerRef = useRef( null );
		const selectedValue = useMemo(
			() =>
				selectionFieldName
					? normalizeSelectedValue(
							getAdvancedValue( attrs, selectionFieldName )
					  )
					: '',
			[ attrs, selectionFieldName ]
		);
		const { html } = useRenderedModuleHtml(
			moduleName,
			attrs,
			selectionFieldName ? Boolean( selectedValue ) : true
		);

		useEffect( () => {
			if ( ! html || ! initializeSliders ) {
				return undefined;
			}

			const timerId = window.setTimeout( () => {
				initializePreviewSliders( previewContainerRef.current );
			}, 200 );

			return () => {
				window.clearTimeout( timerId );
			};
		}, [ html, initializeSliders ] );

		if ( ! html ) {
			return fallback;
		}

		return (
			<div
				ref={ previewContainerRef }
				className="et_pb_module_inner"
				dangerouslySetInnerHTML={ {
					__html: html,
				} }
			/>
		);
	};

export default createRenderedModulePreview;
