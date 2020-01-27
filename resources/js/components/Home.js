import React, { Component } from 'react';

export default class Home extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card p-2 my-4">
                            <h3 className="text-center">Welcome</h3>

                            <div className="card-body">This is a geotechnical project and laboratory information 
                            management system used by various companies and institutions in Ethiopia. Please 
                            login to start using it and click help to get info on how to use it.</div>
                            <a className="btn btn-primary" href="/login">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
