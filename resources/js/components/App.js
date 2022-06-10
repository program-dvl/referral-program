import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch, Routes } from 'react-router-dom'
import Referrals from './Referrals'

class App extends Component {
    render () {
    return (
        <BrowserRouter>
        <div>
            {/* <Header /> */}
            <Routes>
                <Route exact path='/referrals' element={<Referrals/>} />
                {/* <Route exact path='/' element={<Example/>} /> */}
            </Routes>
        </div>
        </BrowserRouter>
    )
    }
}

ReactDOM.render(<App />, document.getElementById('application'))