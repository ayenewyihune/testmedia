import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const linkNone = {
    textDecoration: 'none'
};

export default class Test extends Component {
    render() {
        return (
            <div className="container">
                <h3>Triaxial</h3>
                <hr className="mt-0"/>
                <div className="row">
                    <div className="col-md-5 my-0">
                        <div className="row">
                            <div className="col-6 list-title">
                                <p>Category</p>
                            </div>
                            <div className="col-6 list">
                                <p>Geotechnical</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-5 offset-2">
                        <div className="row">
                            <div className="col-6 list-title">
                                <p>Test Standard</p>
                            </div>
                            <div className="col-6 list">
                                <p>ASTM D2065</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="card mb-3 px-4">
                    <div className="list"><p className="px-0 m-0">Description</p></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                </div>

                <div className="card px-4">
                    <div className="list"><p className="px-0 m-0">Procedures</p></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, quo dolor. Molestias porro, iusto sint odit eveniet accusantium quae, voluptas culpa tempore eius repellat qui placeat velit sequi quasi. Atque?</p>
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Test />, document.getElementById('app'));
}
