import React, { Component } from 'react';
import PropTypes from 'prop-types'
import Header from './Header'
import Footer from './Footer'
import Content from './Content';
import items from './MenuUsuario'

export default class App extends Component {


    static propTypes = {
        children: PropTypes.object.isRequired
    };

    render() {
        const {children} = this.props;
        return (
            <div className="">
                <Header title="Codejobs" items={items}/>
                <Content body={children} />
                <Footer />
            </div>
        );
    }
}
