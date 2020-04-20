import React, {Component} from 'react'
import { agregarProducto } from './ProductFunctions';

class AgregarProducto extends Component {
    constructor(){
        super();
        this.state = {
            codigo:'',
            nombre:'',
            descripcion:'',
            precio:'',
            cantidad:'',
            error: ''
        };
        this.onChange = this.onChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }

    onChange(e){
        this.setState({
            [e.target.name]:e.target.value
        });
    }

    onSubmit(e) {
        e.preventDefault()

        const newProduct = {
            codigo:this.state.codigo,
            nombre:this.state.nombre,
            descripcion:this.state.descripcion,
            precio:this.state.precio,
            cantidad:this.state.cantidad
        }
        agregarProducto(newProduct).then(res => {
            this.props.history.push('/')
        })
    }

    render(){
        const { error } = this.state;
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-6 mt-5 mx-auto">
                        <form  noValidate onSubmit={this.onSubmit}>
                            <h1 className="h3 mb-3 font-weight-normal">
                                Ingrese los datos del producto
                            </h1>
                            {error!=='' ? <p>{error}</p> : ''}
                            <div className="form-group">
                                <label htmlFor="codigo">Codigo</label>
                                <input type="codigo"
                                className="form-control"
                                name="codigo"
                                placeholder="Ingrese el codigo..."
                                value={this.state.codigo}
                                onChange={this.onChange}/>
                            </div>
                            <div className="form-group">
                                <label htmlFor="nombre">Nombre</label>
                                <input type="nombre"
                                    className="form-control"
                                    name="nombre"
                                    placeholder="Ingrese la nombre..."
                                    value={this.state.nombre}
                                    onChange={this.onChange} />
                            </div>
                            <div className="form-group">
                                <label htmlFor="descripcion">Descripcion</label>
                                <input type="descripcion"
                                    className="form-control"
                                    name="descripcion"
                                    placeholder="Ingrese la descripcion..."
                                    value={this.state.descripcion}
                                    onChange={this.onChange} />
                            </div>
                            <div className="form-group">
                                <label htmlFor="precio">Precio</label>
                                <input type="precio"
                                    className="form-control"
                                    name="precio"
                                    placeholder="Ingrese la precio..."
                                    value={this.state.precio}
                                    onChange={this.onChange} />
                            </div>
                            <div className="form-group">
                                <label htmlFor="cantidad">Cantidad</label>
                                <input type="cantidad"
                                    className="form-control"
                                    name="cantidad"
                                    placeholder="Ingrese la cantidad..."
                                    value={this.state.cantidad}
                                    onChange={this.onChange} />
                            </div>
                            <button type="submit" className="btn btn-lg btn-primary btn-block">Agregar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}

export default AgregarProducto
