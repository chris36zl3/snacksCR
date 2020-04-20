import React, { Component } from 'react'
import { register } from './UserFunctions'

class Register extends Component {
    constructor() {
        super();
        this.state = {
            identificacion:'',
            nombre: '',
            apellidos: '',
            email: '',
            password: '',
            acreditado:1
        };
        this.onChange = this.onChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }

    onChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        });
    }

    onSubmit(e) {
        e.preventDefault()

        const newUser = {
            identificacion: this.state.identificacion,
            nombre: this.state.nombre,
            apellidos: this.state.apellidos,
            email: this.state.email,
            password: this.state.password,
            acreditado: this.state.acreditado
        }
        register(newUser).then(res => {
            this.props.history.push('/login')
        })


    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-6 mt-5 mx-auto">
                        <form noValidate onSubmit={this.onSubmit}>
                            <h1 className="h3 mb-3 font-weight-normal">
                                Register
                            </h1>
                            <div className="form-group">
                                <label htmlFor="identificacion">Identificación</label>
                                <input type="text"
                                    className="form-control"
                                    name="identificacion"
                                    placeholder="Ingrese la identificación..."
                                    value={this.state.identificacion}
                                    onChange={this.onChange} />
                            </div>
                            <div className="form-group">
                                <label htmlFor="nombre">Nombre</label>
                                <input type="text"
                                    className="form-control"
                                    name="nombre"
                                    placeholder="Ingrese el nombre..."
                                    value={this.state.nombre}
                                    onChange={this.onChange} />
                            </div>
                            <div className="form-group">
                                <label htmlFor="apellidos">Apellidos</label>
                                <input type="text"
                                    className="form-control"
                                    name="apellidos"
                                    placeholder="Ingrese los apellidos..."
                                    value={this.state.apellidos}
                                    onChange={this.onChange} />
                            </div>
                            <div className="form-group">
                                <label htmlFor="email">Email</label>
                                <input type="email"
                                    className="form-control"
                                    name="email"
                                    placeholder="Ingrese el email..."
                                    value={this.state.email}
                                    onChange={this.onChange} />
                            </div>
                            <div className="form-group">
                                <label htmlFor="password">Password</label>
                                <input type="password"
                                    className="form-control"
                                    name="password"
                                    placeholder="Ingrese la contraseña..."
                                    value={this.state.password}
                                    onChange={this.onChange} />
                            </div>
                            <button type="submit" className="btn btn-lg btn-primary btn-block">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}

export default Register
