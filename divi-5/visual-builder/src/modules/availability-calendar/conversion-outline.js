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
		id: 'shortcode.advanced.id.desktop.value',
		monthstoshow: 'shortcode.advanced.monthstoshow.desktop.value',
		display_price: 'shortcode.advanced.display_price.desktop.value',
		truncate_price: 'shortcode.advanced.truncate_price.desktop.value',
		display_currency: 'shortcode.advanced.display_currency.desktop.value',
		class: 'shortcode.advanced.class.desktop.value',
	},
};

export default conversionOutline;
export { conversionOutline };
