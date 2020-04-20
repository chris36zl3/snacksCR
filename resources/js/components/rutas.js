import React from 'react'
import { Route, Switch } from 'react-router-dom'

import App from './App'
import Inicio from './Inicio'
import Pagina404 from './Pagina404'
import Login from './Login'
import Register from './Register'
import Profile from './Profile'
import AgregarProducto from './AgregarProducto'
import CrearVenta from './CrearVenta'

const AppRoutes = () =>
    <App>
        <Switch>
            <Route exact path="/login" component={Login} />
            <Route exact path="/register" component={Register} />
            <Route exact path="/profile" component={Profile} />
            <Route exact path="/producto" component={AgregarProducto} />
            <Route exact path="/venta" component={CrearVenta} />
            <Route exact path="/" component={Inicio} />
            <Route  component={Pagina404} />
        </Switch>
    </App>

export default AppRoutes
