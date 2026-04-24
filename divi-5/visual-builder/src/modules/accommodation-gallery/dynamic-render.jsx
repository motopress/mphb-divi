import metadata from './module.json';
import { createRenderedModulePreview } from '../../shared/rendered-module-preview';

export const Render = createRenderedModulePreview( {
	moduleName: metadata.name,
	selectionFieldName: 'accommodation_id',
	initializeSliders: true,
} );

export default Render;
