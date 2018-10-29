import React, {Component} from 'react';
import $ from 'jquery';

class MPHB_Divi_Room_Module extends Component {

    static slug = 'mphb-divi-single-accommodation';

    /**
     * Module constructor
     * @param props
     */
    constructor(props){

        super(props);

        this.state = {
            error: null,
            html: 'room',
            isLoaded: false
        }

    }

    /**
     *
     */
    componentDidMount(){

        this.setState({
            isLoaded: true,
            html: this.props.__room
        });

    }

    componentDidUpdate(){

        this.initSlider();

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

    initSlider(){

        const flexsliderGalleries = $('.mphb-flexslider-gallery-wrapper');

        flexsliderGalleries.each( function( index, flexsliderGallery ) {

            new window.MPHB.FlexsliderGallery( flexsliderGallery ).initSliders();

            $(flexsliderGallery).closest('.type-mphb_room_type').on('click', 'a, .button', function (e) {

                e.preventDefault();
                e.stopImmediatePropagation();

            });

        } );

    }
}

export default MPHB_Divi_Room_Module;