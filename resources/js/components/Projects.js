import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const linkNone = {
    textDecoration: 'none'
};

export default class Projects extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-6">
                        <div className="row">
                            <h3 for="ongoingp" className="col-md-4">Ongoing</h3>
                            <div class="col-md-8">
                                <input id="ongoingp" size="43" className="px-2" type="ongoingp" name="ongoingp" placeholder="Search project"></input>
                            </div>
                        </div>
                        <hr className="mt-0"/>
                        <a href="/project/1" style={linkNone}>
                            <div className="card p-2 my-4">
                                <div className="row">
                                    <div className="col-6">
                                        <h3>Proj4526</h3>
                                        <div className="text">Client: Mr. John Smith</div>
                                        <div className="text">Manager: Eng. John Smith</div>
                                    </div>
                                    <div className="col-6 mt-3 vertical-line">
                                        <div className="text">Client: Mr. John Smith</div>
                                        <div className="text">Client: Mr. John Smith</div>
                                        <div className="text">Manager: Eng. John Smith</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div className="col-md-6">
                        <div className="row">
                            <h3 for="completedp" className="col-md-4">Completed</h3>
                            <div class="col-md-8">
                                <input id="completedp" size="43" className="px-2" type="completedp" name="completedp" placeholder="Search project"></input>
                            </div>
                        </div>
                        <hr className="mt-0"/>
                        <a href="/project/2" style={linkNone}>
                            <div className="card p-2 my-4">
                                <div className="row">
                                    <div className="col-6">
                                        <h3>Proj4526</h3>
                                        <div className="text">Client: Mr. John Smith</div>
                                        <div className="text">Manager: Eng. John Smith</div>
                                    </div>
                                    <div className="col-6 mt-3 vertical-line">
                                        <div className="text">Client: Mr. John Smith</div>
                                        <div className="text">Client: Mr. John Smith</div>
                                        <div className="text">Manager: Eng. John Smith</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Projects />, document.getElementById('app'));
}
