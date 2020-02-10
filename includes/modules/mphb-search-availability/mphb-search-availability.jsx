import React, {Component} from 'react';

class MPHB_Divi_Search_Availability_Module extends Component {

    static slug = 'mphb-divi-availability-search';

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
            <div dangerouslySetInnerHTML={{__html: this.props.__form}}></div>
        );

    }

}

export default MPHB_Divi_Search_Availability_Module;