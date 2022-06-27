import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';
import { useNavigate } from "react-router-dom";
import axios from 'axios';

function AddFunds(props)
{
    useEffect(() => {document.title = 'Add funds';}, []);
    const navigate = useNavigate();

    const [accounts, setAccounts] = useState([]);
    const [loggedIn, setLoggedIn] = useState(false);
    useEffect(() => {
        axios.get("http://omnicorp.bank.gov/api/accountinfo")
        .then(res => {
            setAccounts(res.data);
            if(res.data[0] !== 0)
                setLoggedIn(true);
        });
    
    }, []);

    const [amount, setAmount] = useState(0);
    function depositening()
    {
        axios.post('http://omnicorp.bank.gov/api/deposit', {amount: amount})
        .then(res => {
            console.log(res.data.success);
            window.location.reload();
        })
    }

    if (!loggedIn)
        return (
            <>
                <Top />
                <AccountBar />
                <Messages />
                
                <div className="contentContainer">
                    <NavBar />
                    <main  className="mainContetBlock contentBox">
                        There are no funds to add...
                    </main>
                </div>
            </>
        );


    return (
            <>
                <Top />
                <AccountBar />
                <Messages />
                
                <div className="contentContainer">
                    <NavBar />
                    <main  className="mainContetBlock contentBox">
                        {accounts.map((account, index) => {
                            return(
                            <div key={index} className="contentBox fundsButtonBox left">
                                {account.lname} {account.fname}<br />
                                {account.funds} €<hr /><br />
                                <fieldset className="left form">
                                    Deposit amount: <input type="number" name="amount" step="0.01" onChange={e => setAmount(e.target.value)} /><br />
                                    <button className="button" onClick={depositening}>Deposit</button>
                                </fieldset>
                            </div>
                            )})}
                    </main>
                </div>
            </>
        );
}

export default AddFunds;