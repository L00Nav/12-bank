import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';

function Login()
{
    useEffect(() => {document.title = 'Login';}, []);

    const [loggedIn, setLoggedIn] = useState(false);
    const [fullName, setFullName] = useState('');

    function toggleLogin()
    {
        setLoggedIn(!loggedIn);
    }

    function toggleName()
    {
        if (fullName === 'Luna')
            setFullName('');
        else
            setFullName('Luna');
    }

    //useEffect(() => {

    //});

    return (
            <>
                <Top />
                <AccountBar loggedIn={loggedIn} fullName={fullName} />
                <Messages />
                
                <div className="contentContainer">
                    <NavBar />
                    <main  className="mainContetBlock contentBox">
                    <form className="mainContent" action="login" method="post">
                        <label htmlFor="email">Email:</label><br />
                        <input type="email" name="email" /><br /><br />
                        <label htmlFor="pass">Password:</label><br />
                        <input type="password" name="pass" /><br /><br />
                        <input type="hidden" name="requestType" value="createAccount" />
                        <input className="button" type="submit" value="Login" />
                    </form>
                    </main>
                </div>
            </>
        );
}

export default Login;