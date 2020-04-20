import React, { Component } from 'react';
import PropTypes from 'prop-types'
import { Link } from 'react-router-dom'
import '../../../public/css/Header.css';
import Navbar from './Navbar'

export default class Header extends Component {
    static propTypes = {
        title: PropTypes.string.isRequired,
        items: PropTypes.array.isRequired
    };

    render(){
        const {title, items} = this.props;

        return (
            <div className="topnav">
                <ul className="menu">
                    {
                        items && items.map(
                            (items, key) => <li key={key}><Link to={items.url}>{items.nombre}</Link></li>
                        )
                    }
                </ul>
                <Navbar />
            </div>


        );
    }

}
