import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';
import { useNavigate } from "react-router-dom";
import axios from 'axios';

function Login()
{
    useEffect(() => {document.title = 'Create an account';}, []);

    const [messages, setMessages] = useState([{'msg' : 'Test successful', 'type' : 'success'}, {'msg' : 'Test also successful, but with a red X', 'type' : 'alert'}]);

    const navigate = useNavigate();

    const [fname, setFname] = useState('');
    const [lname, setLname] = useState('');
    const [email, setEmail] = useState('');
    const [pnumber, setPnumber] = useState(0);
    const [anumber, setAnumber] = useState(0);
    const [pass, setPass] = useState('');

    useEffect(() => {
        axios.get("http://omnicorp.bank.gov/api/iban")
        .then(res => {
            setAnumber(res.data[0]);
        })
    }, [])

    function createning()
    {
        axios.post('http://omnicorp.bank.gov/api/createuser', {fname: fname, lname: lname, email: email, pnumber: pnumber, anumber: anumber, pass: pass})
        .then(res => {
            console.log(res.data);
            if (res.data.success)
                navigate('/login');
            else
                window.location.reload();
        })
    }

    return (
            <>
                <Top />
                <AccountBar />
                <Messages messages={messages} />
                <div className="contentContainer">
                    <NavBar />
                    <main  className="mainContetBlock contentBox">
                        <fieldset className="mainContent form">
                            <label htmlFor="fname">First name:</label><br />
                            <input type="text" name="fname" onChange={e => setFname(e.target.value)} /><br /><br />
                            <label htmlFor="lname">Last name:</label><br />
                            <input type="text" name="lname" onChange={e => setLname(e.target.value)} /><br /><br />
                            <label htmlFor="email">Email:</label><br />
                            <input type="email" name="email" onChange={e => setEmail(e.target.value)} /><br /><br />
                            <label htmlFor="pnumber">Personal ID number:</label><br />
                            <input type="text" name="pnumber" onChange={e => setPnumber(e.target.value)} /><br /><br />
                            <label htmlFor="anumber">Account number:</label><br />
                            <input type="text" name="anumber" value={anumber} readOnly /><br /><br />
                            <label htmlFor="pass">Password:</label><br />
                            <input type="password" name="pass" onChange={e => setPass(e.target.value)} /><br /><br />
                            <button className="button" onClick={createning}>Register</button>
                        </fieldset>
                    </main>
                </div>
            </>
        );
}

export default Login;