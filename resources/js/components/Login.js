import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Login extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 d-none d-md-block">
                        <img src="http://localhost/labapp/public/images/login_image.jpg" alt="GeoLIMS"/>
                    </div>
                    <div className="col-md-4">
                        <div className="card my-4">
                            <div className="card-header">Login</div>
                            <div className="card-body pb-0">
                                <form method="POST" action="">
                                    <div className="form-group row">
                                        <label for="email" className="col-md-4 col-form-label text-md-right">Username</label>
                                        <div class="col-md-8">
                                            <input id="email" type="email" className="form-control" name="email" required></input>
                                        </div>
                                    </div>
                                    <div className="form-group row">
                                        <label for="password" className="col-md-4 col-form-label text-md-right">Password</label>
                                        <div class="col-md-8">
                                            <input id="password" type="password" className="form-control" name="password" required></input>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-5">
                                            <button type="submit" class="btn btn-primary px-4 mx-2">Login</button>
                                        </div>
                                        <div class="col-md-7">
                                            <div className="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember"></input>
                                                <label class="form-check-label" for="remember">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <a class="btn btn-link mx-2" href="">Forgot Your Password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Login />, document.getElementById('app'));
}
