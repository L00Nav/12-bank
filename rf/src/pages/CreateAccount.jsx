import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';

function Login()
{
    useEffect(() => {document.title = 'Create an account';}, []);

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
                {/*
                <button onClick={toggleLogin}>Login / out</button>
                <button onClick={toggleName}>Toggle name</button>
                */}
                <div className="contentContainer">
                    <NavBar />
                    <main  className="mainContetBlock contentBox">
                        <form className="mainContent" action="createAccount" method="post">
                            <label htmlFor="fname">First name:</label><br />
                            <input type="text" name="fname" /><br /><br />
                            <label htmlFor="lname">Last name:</label><br />
                            <input type="text" name="lname" /><br /><br />
                            <label htmlFor="email">Email:</label><br />
                            <input type="email" name="email" /><br /><br />
                            <label htmlFor="pnumber">Personal ID number:</label><br />
                            <input type="text" name="pnumber" /><br /><br />
                            <label htmlFor="anumber">Account number:</label><br />
                            <input type="text" name="anumber" value="1337" readOnly /><br /><br />
                            <label htmlFor="pass">Password:</label><br />
                            <input type="password" name="pass" /><br /><br />
                            <input className="button" type="submit" value="Register" />
                        </form>
                    </main>
                </div>
            </>
        );
}

export default Login;