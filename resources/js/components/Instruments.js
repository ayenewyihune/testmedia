import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const linkNone = {
    textDecoration: 'none'
};

const description = {
    fontSize: 12
};

export default class Projects extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card p-2 my-4">
                            <h3 className="text-center">Under construction</h3>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Projects />, document.getElementById('app'));
}
