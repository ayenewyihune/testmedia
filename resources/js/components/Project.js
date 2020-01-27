import React, { Component } from 'react';
import ReactDOM from 'react-dom';

const linkNone = {
    textDecoration: 'none'
};

export default class Project extends Component {
    render() {
        return (
            <div className="container">
                <h2>Proj4526</h2>
                <hr className="mt-0"/>
                <div className="row">
                    <div className="col-6">
                        <div className="row">
                            <div className="col-4 list-title">
                                <p>Client Name</p>
                                <p>Manager</p>
                                <p>Location</p>
                                <p>Description</p>
                            </div>
                            <div className="col-8 list">
                                <p>Ato Dereje Abebe</p>
                                <p>Eng. Abrham Ephrem</p>
                                <p>Addis Ababa</p>
                                <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo reprehenderit similique, commodi quod dicta nobis nisi nulla autem eligendi iure odit. Quam quaerat ullam officiis vitae omnis cupiditate vero libero.</div>
                            </div>
                        </div>
                    </div>
                    <div className="col-6 mt-3 vertical-line">
                        <div className="row">
                            <div className="col-4 list-title">
                                <p>Start Date</p>
                                <p>Submission Date</p>
                                <p>Cost</p>
                                <p>Expenditure</p>
                                <p>Submission Status</p>
                                <p>Payment Status</p>
                                <p>Amount Payed</p>
                            </div>
                            <div className="col-8 list">
                                <p>21/12/19</p>
                                <p>01/01/20</p>
                                <p>20000 birr</p>
                                <p>2500 birr</p>
                                <p>Submitted</p>
                                <p>Payed</p>
                                <p>19000 birr</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Project />, document.getElementById('app'));
}
