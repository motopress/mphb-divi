import metadata from './module.json';
import { createRenderedModulePreview } from '../../shared/rendered-module-preview';

export const Render = createRenderedModulePreview( {
	moduleName: metadata.name,
	initializeSliders: true,
} );

export default Render;
