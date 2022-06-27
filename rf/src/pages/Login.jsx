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
    const navigate = useNavigate();
    useEffect(() => {
        axios.get('http://omnicorp.bank.gov/api/acbar')
        .then(res => {
            if(res.data.loggedIn)
                navigate('/accounts');
        })
    })

    useEffect(() => {document.title = 'Login';}, []);

    
    const [email, setEmail] = useState('');
    const [pass, setPass] = useState('');
    function logening()
    {
        axios.post('http://omnicorp.bank.gov/api/login', {email: email, pass: pass})
        .then(res => {
            console.log(res.data.success);
            if(res.data.success)
            {
                navigate('/accounts');
            }
            else
                window.location.reload();
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
                            <input type="email" name="email" onChange={e => setEmail(e.target.value)} /><br /><br />
                            <label htmlFor="pass">Password:</label><br />
                            <input type="password" name="pass" onChange={e => setPass(e.target.value)} /><br /><br />
                            <input type="hidden" name="requestType" value="createAccount" />
                            <button className="button" onClick={logening}>Login</button>
                        </fieldset>
                    </main>
                </div>
            </>
        );
}

export default Login;