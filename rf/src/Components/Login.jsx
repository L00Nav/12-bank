import Top from "./Top";
import AccountBar from "./AccountBar";
import NavBar from "./NavBar";
import Messages from "./Messages";
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

    const [messages, setMessages] = useState([{'msg' : 'Test successful', 'type' : 'success'}, {'msg' : 'Test also successful, but with a red X', 'type' : 'alert'}]);

    //useEffect(() => {

    //});

    return (
            <>
                <Top />
                <AccountBar loggedIn={loggedIn} fullName={fullName} />
                <Messages messages={messages} />
                <button onClick={toggleLogin}>Login / out</button>
                <button onClick={toggleName}>Toggle name</button>
                
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