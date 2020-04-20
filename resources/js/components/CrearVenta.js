import React, { Component } from 'react'
import { Redirect } from 'react-router-dom'
import axios from 'axios';
import { crearVenta } from './VentaFunctions';
import Select from "react-dropdown-select";
import url from '../url';
import VentaForm from './VentaForm'
import VentaList from './VentaList'

class CrearVenta extends Component {
    constructor() {
        super();
        this.state = {
            readyToRedirect: false,
            redirect: false,
            ready: false,
            ventas: [],
            error: '',
            productos: [],
            form: {
                cantidad: '',
                producto_id: '',
            }
        };
        this.handleChange = this.handleChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
    }



    handleSubmit(e) {
        e.preventDefault()
        try {
            const datos = {
                producto_id: this.state.form.producto_id,
                cantidad: this.state.form.cantidad
            }

            let config = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            }

            fetch("/api/crearVenta", config)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    this.setState({
                        ventas: dthis.state.ventas.concat(data)
                    })
                })
                .catch(error => {
                    console.log(error);
                })

        } catch (error) {
            this.setState({
                error
            })
        }
    }

    handleChange(e) {
        this.setState({
            form: {
                ...this.state.form,
                [e.target.name]: e.target.value
            }
        })
    }

    getProductos() {
        fetch(
            "/api/producto"
        )
            .then(response => {
                return response.json();

            })
            .then(data => {
                console.log(data.Productos)

                this.setState({
                    productos: data.Productos
                })
            })
            .catch(error => {
                console.log(error);
            })
    }

    getVentas() {
        axios.get(url + 'api/ventas').then(response => {
            return response.json();

        })
            .then(data => {
                console.log(data.ventas)

                this.setState({
                    productos: data.ventas
                })
            }).catch(error => {
            if (typeof error.response !== 'undefined' && typeof error.response.status !== 'undefined') {
                this.errores(error)
            }
            else {
                console.log(error)
            }
        })
    }

    componentDidMount() {
        this.getProductos();
        this.getVentas();
    }

    errores(error) {
        switch (error.response.status) {

            case 422:
                this.setState({
                    message: error.response.data.errors
                })
                break;

            case 403:
                this.setState({
                    readyToRedirect: true,
                })
                break;

            case 401:
                window.location.replace(url + 'login')
                break;

            case 409:
                this.setState({
                    error409: true
                })
                break;

            default:
                console.log(error)
                break;
        }
    }

    render() {
        const { error } = this.state;

        if (this.state.readyToRedirect) {
            return <Redirect to="/" />
        }

        return (
            <div className="container">
                <p className="h1">Ingrese los datos de la venta</p>
                <div className="row">
                    <div className="col">
                        <VentaForm
                            form={this.state.form}
                            productos={this.state.productos}
                            onChange={this.handleChange}
                            onSubmit={this.handleSubmit}
                        />
                    </div>

                    <div className="col">
                        <VentaList
                            ventas={this.state.ventas}
                        />
                    </div>
                </div>
                <div className="form-group">
                    <button type="submit" className="btn btn-success btn-lg">Finalizar Venta</button>
                </div>
            </div>
        )
    }
}

export default CrearVenta
