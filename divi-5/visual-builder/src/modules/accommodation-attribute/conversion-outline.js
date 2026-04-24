const conversionOutline = {
	advanced: {
		admin_label: 'module.meta.adminLabel',
		animation: 'module.decoration.animation',
		background: 'module.decoration.background',
		disabled_on: 'module.decoration.disabledOn',
		overflow: 'module.decoration.overflow',
		position_fields: 'module.decoration.position',
		scroll: 'module.decoration.scroll',
		sticky: 'module.decoration.sticky',
		transform: 'module.decoration.transform',
		transition: 'module.decoration.transition',
		z_index: 'module.decoration.zIndex',
		margin_padding: 'module.decoration.spacing',
		max_width: 'module.decoration.sizing',
		height: 'module.decoration.sizing',
		link_options: 'module.advanced.link',
		fonts: {
			module: 'module.decoration.font',
		},
		filters: {
			default: 'module.decoration.filters',
		},
		box_shadow: {
			default: 'module.decoration.boxShadow',
		},
		borders: {
			default: 'module.decoration.border',
		},
		display_conditions: 'module.decoration.conditions',
	},
	css: {
		after: 'css.*.after',
		before: 'css.*.before',
		main_element: 'css.*.mainElement',
		free_form: 'css.*.freeForm',
	},
	module: {
		accommodation_id: 'shortcode.advanced.accommodation_id.desktop.value',
		selected_attribute:
			'shortcode.advanced.selected_attribute.desktop.value',
		show_label: 'shortcode.advanced.show_label.desktop.value',
	},
};

export default conversionOutline;
export { conversionOutline };
