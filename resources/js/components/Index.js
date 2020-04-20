import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import AppRoutes from './rutas';

if (document.getElementById('index')) {
    ReactDOM.render(
    <Router>
        <AppRoutes />
    </Router>,
    document.getElementById('index'));
}
