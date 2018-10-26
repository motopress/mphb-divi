import React, {Component} from 'react';

class MPHB_Divi_Booking_Form_Module extends Component {

    static slug = 'mphb-divi-booking-form';

    /**
     * Module constructor
     * @param props
     */
    constructor(props){

        super(props);

        this.state = {
            error: null,
            html: 'rates',
            isLoaded: false
        }

    }

    /**
     *
     */
    componentDidMount(){

        this.setState({
            isLoaded: true,
            html: this.props.__form
        });

    }

    /**
     * Module render in VB
     */
    render() {

        const { error, html, isLoaded } = this.state;

        if(error){
            return(error);
        }else if(!isLoaded) {
            return (<div className="et-fb-loader-wrapper"><div className="et-fb-loader"></div></div>);
        }else{
            return (
                <div dangerouslySetInnerHTML={{__html: html}}></div>
            );
        }

    }

}

export default MPHB_Divi_Booking_Form_Module;