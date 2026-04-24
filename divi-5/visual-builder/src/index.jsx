import modules from './modules';

const vendor = window && window.vendor ? window.vendor : {};
const wpPackages = vendor.wp ? vendor.wp : {};
const wpHooks = wpPackages.hooks ? wpPackages.hooks : {};
const diviPackages = window && window.divi ? window.divi : {};
const diviModule = diviPackages.module ? diviPackages.module : {};
const diviModuleLibrary = diviPackages.moduleLibrary
	? diviPackages.moduleLibrary
	: {};
const addAction = wpHooks.addAction;
const ModuleContainer = diviModule.ModuleContainer;
const StyleContainer = diviModule.StyleContainer;
const CssStyle = diviModule.CssStyle;
const registerModule = diviModuleLibrary.registerModule;

const ModuleStyles = ( {
	elements,
	attrs,
	mode,
	state,
	noStyleTag,
	orderClass,
} ) => (
	<StyleContainer mode={ mode } state={ state } noStyleTag={ noStyleTag }>
		{ elements.style( {
			attrName: 'module',
		} ) }
		<CssStyle
			selector={ orderClass }
			attr={ attrs.css }
			cssFields={ elements?.moduleMetadata?.customCssFields }
		/>
	</StyleContainer>
);

const Placeholder = ( { title, description } ) => (
	<div
		style={ {
			background: '#f6f7f7',
			borderRadius: '10px',
			padding: '3em 1em',
		} }
	>
		<p
			style={ {
				textAlign: 'center',
				fontWeight: '700',
				fontSize: '1.25em',
			} }
		>
			{ title }
		</p>
		{ description ? (
			<p style={ { textAlign: 'center' } }>{ description }</p>
		) : null }
	</div>
);

const Edit = ( props ) => {
	const { attrs, id, name, elements, metadata, previewRender } = props;
	const PreviewRender = previewRender;

	return (
		<ModuleContainer
			attrs={ attrs }
			elements={ elements }
			id={ id }
			moduleClassName={ metadata.moduleClassName }
			name={ name }
			stylesComponent={ ModuleStyles }
		>
			{ PreviewRender ? (
				<PreviewRender
					attrs={ attrs }
					fallback={
						<Placeholder
							title={ metadata.title }
							description={ metadata.description }
						/>
					}
				/>
			) : (
				<Placeholder
					title={ metadata.title }
					description={ metadata.description }
				/>
			) }
		</ModuleContainer>
	);
};

const createModule = (
	metadata,
	conversionOutline,
	settings,
	previewRender
) => ( {
	metadata,
	conversionOutline,
	settings,
	renderers: {
		edit: ( props ) => (
			<Edit
				{ ...props }
				metadata={ metadata }
				previewRender={ previewRender }
			/>
		),
	},
	placeholderContent: {
		module: {
			meta: {
				adminLabel: {
					desktop: {
						value: metadata.title,
					},
				},
			},
		},
	},
} );

if ( addAction && registerModule ) {
	addAction(
		'divi.moduleLibrary.registerModuleLibraryStore.after',
		'mphbDivi.registerModules',
		() => {
			modules.forEach(
				( { metadata, conversionOutline, settings, previewRender } ) =>
					registerModule(
						metadata,
						createModule(
							metadata,
							conversionOutline,
							settings,
							previewRender
						)
					)
			);
		}
	);
}
