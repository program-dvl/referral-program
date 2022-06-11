import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch, Routes } from 'react-router-dom'
import Referrals from './Referrals'
import ReferralList from './ReferralList'

class App extends Component {
    render () {
    return (
        <BrowserRouter>
        <div>
            <Routes>
                <Route exact path='/referrals' element={<Referrals/>} />
                <Route exact path='/admin/referrals' element={<ReferralList/>} />
            </Routes>
        </div>
        </BrowserRouter>
    )
    }
}

ReactDOM.render(<App />, document.getElementById('application'))