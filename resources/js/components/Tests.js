import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const linkNone = {
    textDecoration: 'none'
};

const description = {
    fontSize: 12
};

export default class Tests extends Component {
    render() {
        return (
                <div className="container">
                    <div className="row">
                        <div className="col-lg-4">
                            <div className="row">
                                <h3 htmlFor="ongoingp" className="col-4">Geotech</h3>
                                <div className="col-8 text-right">
                                    <input id="ongoingp" size="10%" className="px-2" type="ongoingp" name="ongoingp" placeholder="Search test"></input>
                                </div>
                            </div>
                            <hr className="mt-0"/>
                            
                                <a href="/test/1" style={linkNone}>
                                    <div className="card p-2 my-4">
                                        <div className="row">
                                            <div className="col-5">
                                                <img src="http://localhost/labapp/public/images/triaxial.jpg" alt="triaxial" height="100"/>
                                            </div>
                                            <div className="col-7 vertical-line">
                                                <h3>Triaxial</h3>
                                                <div className="text" style={description}>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit amet consectetur adipisicing elit.</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                
                            
                        </div>

                        <div className="col-lg-4">
                            <div className="row">
                                <h3 htmlFor="ongoingp" className="col-4">Road</h3>
                                <div className="col-8 text-right">
                                    <input id="ongoingp" size="10%" className="px-2" type="ongoingp" name="ongoingp" placeholder="Search test"></input>
                                </div>
                            </div>
                            <hr className="mt-0"/>
                            <a href="/project/1" style={linkNone}>
                                <div className="card p-2 my-4">
                                    <div className="row">
                                        <div className="col-5">
                                            <img src="http://localhost/labapp/public/images/triaxial.jpg" alt="triaxial" height="100"/>
                                        </div>
                                        <div className="col-7 vertical-line">
                                            <h3>Marshal</h3>
                                            <div className="text" style={description}>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit amet consectetur adipisicing elit.</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div className="col-lg-4">
                            <div className="row">
                                <h3 htmlFor="ongoingp" className="col-4">Material</h3>
                                <div className="col-8 text-right">
                                    <input id="ongoingp" size="10%" className="px-2" type="ongoingp" name="ongoingp" placeholder="Search test"></input>
                                </div>
                            </div>
                            <hr className="mt-0"/>
                            <a href="/project/1" style={linkNone}>
                                <div className="card p-2 my-4">
                                    <div className="row">
                                        <div className="col-5">
                                            <img src="http://localhost/labapp/public/images/triaxial.jpg" alt="triaxial" height="100"/>
                                        </div>
                                        <div className="col-7 vertical-line">
                                            <h3>Cube</h3>
                                            <div className="text" style={description}>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit amet consectetur adipisicing elit.</div>
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

ReactDOM.render(<Tests />, document.getElementById('app'));
