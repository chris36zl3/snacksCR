import React from 'react'

const VentaList = ({ ventas }) => (
    <div className="table-responsive">
        {ventas.length !== 0 ?(
                    <table className="table table-sm">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            {ventas.map((venta) => (
                                <tr key={venta.id}>
                                    <td>{venta.producto.id}</td>
                                    <td>{venta.producto.precio}</td>
                                    <td>{venta.cantidad}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                ) :
                (
                    <div className="alert alert-warning" role="alert">
                        No hay registros de ventas
                    </div>

                )
        }
    </div >
)

export default VentaList
