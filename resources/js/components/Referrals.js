import React, { Component } from 'react'
import { ReactMultiEmail, isEmail } from 'react-multi-email';
import 'react-multi-email/style.css';
import {NotificationContainer, NotificationManager} from 'react-notifications';
import {sendReferral} from "../Services/referral-service";
import 'react-notifications/lib/notifications.css';
import $ from 'jquery'; 


class Referrals extends Component {

  constructor(props) {
      super(props);
      this.state = {
        emails: [],
        isDisabled: false
      };
      this.sendReferral = this.sendReferral.bind(this);
      // this.createNotification = this.createNotification.bind(this);
  }

  sendReferral() {
    
    this.setState({isDisabled: true});

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    var body = { 
      emails: this.state.emails,
      _token: csrf_token,
    }

    sendReferral(body)
        .then((data) => {
          this.setState({isDisabled: false});
          if(data.errors) {
            for (var k in data.errors) {
              NotificationManager.error(data.errors[k][0], data.message);
              break;
            }
          } else {
            if (data.code == 200) {
              this.setState({emails: []});
              NotificationManager.success(data.message, 'Success!');
            } else {
              NotificationManager.error(data.message, 'Error!');
            }
          }

        }
      )
    .catch((err) => console.log(err))
  }

  render () {
      const { emails } = this.state;
      return (
        <div className="container">
          <div className="row justify-content-center">
              <div className="col-md-8">
                  <div className="card">
                      <div className="card-header container-fluid">
                        <div className="row">
                          <div className="col-md-10">
                            Refer a User
                          </div>
                          <div className="col-md-2 float-right">
                            <a href="/home">Dashboard</a>  
                          </div>
                        </div>
                      </div>

                      <div className="card-body">
                        <h3>Email your invite</h3>
                        <div className="row" id="meta-search">
                          <div className="col-sm-10">
                                <ReactMultiEmail
                                  placeholder="placeholder"
                                  emails = {emails}
                                  onChange = {_emails =>
                                    this.setState({ emails: _emails })
                                  }
                                  validateEmail={email => {
                                    return isEmail(email); // return boolean
                                  }}
                                  getLabel={
                                    (email, index, removeEmail) => {
                                    return (
                                      <div data-tag key={index}>
                                        {email}
                                        <span data-tag-handle onClick={() => removeEmail(index)}>
                                          ×
                                        </span>
                                      </div>
                                    );
                                  }}
                                />
                          </div>
                          <div className="col-sm-2">
                              <button type="button" onClick={() => this.sendReferral()} className="btn btn-primary btn-lg" aria-label="Right Align" disabled={this.state.emails.length == 0 || this.state.isDisabled}>
                                  Send <span className="glyphicon glyphicon-send" aria-hidden="true"></span>
                              </button>
                          </div> 
                          <NotificationContainer/>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      )
  }
}
export default Referrals