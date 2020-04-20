import axios from 'axios'

export const agregarProducto = newProduct => {
    return axios.post('api/registrarProducto',newProduct, {
        headers:{'Content-Type':'application/json'}
    })
    .then(res=>{
        console.log(res)
    })
    .catch(err => {
        console.log(err)
    })
}
