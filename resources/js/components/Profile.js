import React, { Component } from 'react'
import {getProfile} from './UserFunctions'

class Profile extends Component {
    constructor() {
        super();
        this.state = {
            nombre:'',
            email: '',
            error: null
        };
    }

    componentDidMount(){
        getProfile().then(res => {
            this.setState({
                nombre:res.user.nombre,
                email:res.user.email
            })
        })
    }

    render() {
        return (
            <div className="container">
                <div className="jumbotron mt-5">
                    <div className="col-sm-4 mx-auto">
                        <h1 className="text-center">PROFILE</h1>
                    </div>
                    <table className="table col-md-4 mx-auto">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{this.state.nombre}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{this.state.email}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        )
    }
}

export default Profile
