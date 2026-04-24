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
		ids: 'shortcode.advanced.ids.desktop.value',
		posts_per_page: 'shortcode.advanced.posts_per_page.desktop.value',
		orderby: 'shortcode.advanced.orderby.desktop.value',
		order: 'shortcode.advanced.order.desktop.value',
		meta_key: 'shortcode.advanced.meta_key.desktop.value',
		meta_type: 'shortcode.advanced.meta_type.desktop.value',
		class: 'shortcode.advanced.class.desktop.value',
	},
};

export default conversionOutline;
export { conversionOutline };
