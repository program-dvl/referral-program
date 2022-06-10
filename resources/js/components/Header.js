import React, { Component } from 'react'
import { Link } from 'react-router-dom'

    // const Header = () => (
    //   <nav className='navbar navbar-expand-md navbar-light navbar-laravel'>
    //     <div className='container'>
    //       <Link className='navbar-brand' to='/'>Tasksman</Link>
    //     </div>
    //   </nav>

    // <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    //     <div class="container">
    //         <a class="navbar-brand" href="/">
    //             Contactus Coding Test
    //         </a>
    //         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    //             <span class="navbar-toggler-icon"></span>
    //         </button>

    //         <div class="collapse navbar-collapse" id="navbarSupportedContent">     
    //             <ul class="navbar-nav me-auto">

    //             </ul>  
    //             <ul class="navbar-nav ms-auto">
    //                 <li class="nav-item dropdown">
    //                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    //                         User name
    //                     </a>
    //                     <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    //                         <a class="dropdown-item" onClick={sayHello}>
    //                             Logout
    //                         </a>
    //                         {/* <form id="logout-form" action="logout" method="POST" class="d-none"> */}
    //                             {/* @csrf */}
    //                         {/* </form> */}
    //                     </div>
    //                 </li>
    //             </ul>
    //         </div>
    //     </div>
    // </nav>
    // )

    class Header extends Component {

        constructor(props) {
            super(props);
            this.sayHello = this.sayHello.bind(this);
        }

        sayHello() {
            alert('Hello!');
        }

        render () {
            return (
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="/">
                            Contactus Coding Test
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">     
                            <ul class="navbar-nav me-auto">

                            </ul>  
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item" onClick={() => this.sayHello()}>
                                        Logout
                                    </a>
                                    {/* <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" onClick={() => this.sayHello()}>
                                            Logout
                                        </a> */}
                                        {/* <form id="logout-form" action="logout" method="POST" class="d-none"> */}
                                            {/* @csrf */}
                                        {/* </form> */}
                                    {/* </div> */}
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            )
        }
    }
    export default Header