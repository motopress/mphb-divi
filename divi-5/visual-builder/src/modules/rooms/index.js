import metadata from './module.json';
import conversionOutline from './conversion-outline';
import Render from './dynamic-render';

export { metadata };

export default {
	metadata,
	conversionOutline,
	previewRender: Render,
};
