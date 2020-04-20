import axios from 'axios'

export const register = newUser => {
    return axios.post('api/v1/register',newUser, {
        headers:{'Content-Type':'application/json'}
    })
    .then(res=>{
        console.log(res)
    })
    .catch(err => {
        console.log(err)
    })
}

export const login = user => {
    return axios
    .post('api/v1/login', {
        email:user.email,
        password:user.password
    })
    .then(res => {
        localStorage.setItem('usertoken',res.data.token)
        return res.data
    })
    .catch(error => {
        return error
    })
}

export const getProfile = () => {
    return axios.get('api/v1/profile', {
            headers: { Authorization: `Bearer ${localStorage.usertoken}` }
        })
        .then(res => {
            console.log(res)
            return res.data //(data,200)
        })
        .catch(error => {
            return error
        })
}
