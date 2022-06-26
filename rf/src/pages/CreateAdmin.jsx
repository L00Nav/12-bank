import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';

function Login()
{
    useEffect(() => {document.title = 'Create admin account';}, []);

    const [loggedIn, setLoggedIn] = useState(false);
    const [fullName, setFullName] = useState('');

    return (
            <>
                <Top />
                <AccountBar loggedIn={loggedIn} fullName={fullName} />
                <Messages />
                
                <div className="contentContainer">
                    <NavBar />
                    <main  className="mainContetBlock contentBox">
                        <form className="mainContent" action="adminCreate" method="post">
                            <label htmlFor="adminName">Username:</label><br />
                            <input type="text" name="adminName" /><br /><br />
                            <label htmlFor="adminPass">Password:</label><br />
                            <input type="password" name="adminPass" /><br /><br />
                            <input className="button" type="submit" value="Register" />
                        </form>
                    </main>
                </div>
            </>
        );
}

export default Login;