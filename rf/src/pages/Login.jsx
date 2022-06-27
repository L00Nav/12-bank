import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';
import axios from 'axios';
import { useNavigate } from "react-router-dom";
//import Cookies from 'universal-cookie';

function Login()
{
    useEffect(() => {document.title = 'Login';}, []);

    //const [email, setEmail] = useState('');
    const navigate = useNavigate();
    function logening()
    {
        axios.post('http://omnicorp.bank.gov/api/login', {email: "lunar@biscuit.com", pass: 'sausainis'})
        .then(res => {
            console.log(res.data.success);
            if(res.data.success)
            {
                navigate('/accounts');
            }
            else
                navigate('/login');
        })
    }

    return (
            <>
                <Top />
                <AccountBar />
                <Messages />
                
                <div className="contentContainer">
                    <NavBar />
                    <main  className="mainContetBlock contentBox">
                        <fieldset className="mainContent form">
                            <label htmlFor="email">Email:</label><br />
                            <input type="email" name="email" /><br /><br />
                            <label htmlFor="pass">Password:</label><br />
                            <input type="password" name="pass" /><br /><br />
                            <input type="hidden" name="requestType" value="createAccount" />
                            <button className="button" onClick={logening}>Login</button>
                        </fieldset>
                    </main>
                </div>
            </>
        );
}

export default Login;