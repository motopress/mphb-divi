import { useFetch } from '@divi/rest';
import { useEffect, useMemo, useRef, useState } from 'react';

export const useRenderedModuleHtml = ( moduleName, attrs, enabled = true ) => {
	const [ html, setHtml ] = useState( '' );
	const { fetch: fetchPreview, abort } = useFetch();
	const fetchPreviewRef = useRef( fetchPreview );
	const abortRef = useRef( abort );
	const previewKey = useMemo(
		() => JSON.stringify( attrs && attrs.shortcode ? attrs.shortcode : {} ),
		[ attrs ]
	);

	useEffect( () => {
		fetchPreviewRef.current = fetchPreview;
		abortRef.current = abort;
	}, [ abort, fetchPreview ] );

	useEffect( () => {
		abortRef.current();

		if ( ! enabled ) {
			setHtml( '' );
			return undefined;
		}

		fetchPreviewRef
			.current( {
				restRoute: '/mphb-divi/v1/render-module',
				method: 'POST',
				data: {
					moduleName,
					attrs,
				},
				forceRequest: true,
			} )
			.then( ( nextResponse ) => {
				setHtml(
					nextResponse && 'string' === typeof nextResponse.html
						? nextResponse.html
						: ''
				);
			} )
			.catch( () => {
				setHtml( '' );
			} );

		return () => {
			abortRef.current();
		};
	}, [ attrs, enabled, moduleName, previewKey ] );

	return {
		html,
	};
};

export default useRenderedModuleHtml;
