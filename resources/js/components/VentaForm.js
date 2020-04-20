import React from 'react';

const VentaForm = ({ form, productos, onChange, onSubmit }) => (
    <form
        onSubmit={onSubmit}
    >
        <div className="form-group">
            <label htmlFor="producto">Producto</label>
            <select className="form-control"
                value={form.producto_id}
                onChange={onChange}>
                {productos.map(pro => (
                    <option key={pro.id} value={pro.id}>
                        {pro.nombre}
                    </option>
                ))}
            </select>
        </div>
        <div className="form-group">
            <label htmlFor="cantidad">Cantidad</label>
            <input type="cantidad"
                className="form-control"
                id="cantidad"
                name="cantidad"
                placeholder="Ingrese la cantidad..."
                value={form.cantidad}
                onChange={onChange} />
        </div>
        <button type="submit" className="btn btn-outline-primary">Agregar Linea</button>

    </form>
)

export default VentaForm
