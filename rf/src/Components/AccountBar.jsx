import {useState, useEffect} from 'react';
import axios from 'axios';
import { useNavigate } from "react-router-dom";

function AccountBar(props)
{
    const [loggedIn, setLoggedIn] = useState(false);
    const [fullName, setFullName] = useState('');
    useEffect(() => {
        if(props.loggedIn === undefined)
        {
            axios.get('http://omnicorp.bank.gov/api/acbar')
            .then(res => {
                setLoggedIn(res.data.loggedIn);
                setFullName(res.data.fullName);
            })
        }
        else
        {
            setLoggedIn(props.loggedIn);
            setFullName(props.fullName);
        }
    }, []);

    const navigate = useNavigate();
    function logoutening()
    {
        axios.get('http://omnicorp.bank.gov/api/logout')
        .then(res => {
            navigate('/login');
        });
    }

    if (loggedIn === true)
    {
        return (
            <div  className="accountBar">
                <div className="contentBox">
                    <a className="navLink" href="accounts">{fullName}</a>
                </div>
                <div className="contentBox">
                    <fieldset className="form">
                        <button className="logout" type="button" onClick={logoutening}>Logout</button>
                    </fieldset>
                </div>
            </div>
        );
    }

    return (
        <>
            <div  className="accountBar">
                <div className="contentBox">
                    <a className="navLink" href="login">Login</a>
                </div>
                <div className="contentBox">
                    <a className="navLink" href="account-creation-form">Register</a>
                </div>
            </div>
        </>
    );
}

export default AccountBar;