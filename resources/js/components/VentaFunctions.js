import axios from 'axios'

export const crearVenta = newVenta => {
    return axios.post('api/crearVenta',newVenta, {
        headers:{'Content-Type':'application/json'}
    })
    .then(res=>{
        console.log(res)
    })
    .catch(err => {
        console.log(err)
    })
}
