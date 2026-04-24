import metadata from './module.json';
import conversionOutline from './conversion-outline';
import { createAccommodationTypeSettingsWithConfig } from '../../shared/accommodation-type-settings-content';
import Render from './dynamic-render';

export { metadata };

export default {
	metadata,
	conversionOutline,
	settings: {
		content: createAccommodationTypeSettingsWithConfig( {
			fieldNames: [ 'shortcodeAdvancedAccommodation_id' ],
			allowCurrent: true,
		} ),
	},
	previewRender: Render,
};
