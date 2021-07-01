import React, {Component} from 'react';
import $ from "jquery";

class MPHB_Divi_Booking_Confirmation_Module extends Component {

	static slug = 'mphb-divi-booking-confirmation';

	/**
	 * Module constructor
	 * @param props
	 */
	constructor(props) {

		super(props);

	}

	/**
	 * Module render in VB
	 */
	render() {

		return (
			<div dangerouslySetInnerHTML={{__html: this.props.__booking}}></div>
		);

	}

}

export default MPHB_Divi_Booking_Confirmation_Module;