import React, {Component} from 'react'
import {BrowserRouter as Router, Link, Route} from 'react-router-dom';
import Home from './Home';
import Tests from './Tests';
import Instruments from './Instruments';

export default class Header extends Component {

render() {
    return (
        <Router>
            <div>
            <nav className="navbar navbar-expand-sm navbar-dark bg-info mb-4">
                <div className="container">
                <Link className="navbar-brand py-0 my-0" to="/"><img src="http://localhost/labapp/public/images/logo.png" alt="Geolab" className="brand-image"/></Link>

                    <Link className="navbar-brand" to="/">Geolab</Link>
                    <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span className="navbar-toggler-icon"></span>
                    </button>

                    <div className="collapse navbar-collapse" id="navbarSupportedContent">
                        {/* <!-- Left Side Of Navbar --> */}
                        <ul className="navbar-nav mr-auto">

                        </ul>

                        {/* <!-- Right Side Of Navbar --> */}
                        <ul className="navbar-nav ml-auto">
                            {/* <!-- Authentication Links --> */}
                            <li className="nav-item">
                                <Link className="nav-link" to="/tests">Tests</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/instruments">Instruments</Link>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                </nav>

                <Route exact path='/' component={Home}/>
                <Route exact path='/tests' component={Tests}/>
                <Route exact path='/instruments' component={Instruments}/>
            </div>
        </Router>
    )
  }
}