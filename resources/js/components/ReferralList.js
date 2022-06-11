import React, { Component } from 'react';
import Table from 'react-bootstrap/Table'
import 'bootstrap/dist/css/bootstrap.css';

class ReferralList extends Component {

    constructor(props) {
        super(props);
        this.state = {
            list: []
        }
    }
    
    componentDidMount() {
        const apiUrl = '/referral/list';
        fetch(apiUrl)
          .then((response) => response.json())
          .then((data) => 
            this.setState({list: data.data})
          );
      }

    render () {
        return (
            <div>
                <div><h3>Referral List</h3></div>
            <Table stripped='true' bordered='true' hover='true'>
                <thead>
                    <tr>
                        <th width="250">Referrer</th>
                        <th width="250">Email Referred</th>
                        <th width="250">Date</th>
                        <th width="250">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {this.state.list.map((referral, index) => (
                        <tr key={index+1}>
                            <td>{referral.user.name} ( {referral.user.email} )</td>
                            <td>{referral.referral_email}</td>
                            <td>{referral.created}</td>
                            <td>{referral.status_name}</td>
                        </tr>
                    ))}
                </tbody>
            </Table>
            </div>
        )
    }
}
export default ReferralList