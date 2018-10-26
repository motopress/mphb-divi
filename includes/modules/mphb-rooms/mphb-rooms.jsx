import React, {Component} from 'react';
import $ from 'jquery';

class MPHB_Divi_Rooms_Module extends Component {

    static slug = 'mphb-divi-accommodations';

    /**
     * Module constructor
     * @param props
     */
    constructor(props){
        super(props);
        this.state = {
            error: null,
            html: 'rooms',
            isLoaded: false
        }
    }

    /**
     *
     */
    componentDidMount(){
        this.setState({
            isLoaded: true,
            html: this.props.__rooms
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
            $(flexsliderGallery).find('a').off("click");
            $(flexsliderGallery).on('click', 'a', function (e) {
                e.stopImmediatePropagation();
            })

        } );

    }
}

export default MPHB_Divi_Rooms_Module;