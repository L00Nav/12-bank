import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';
import axios from 'axios';

function WithdrawFunds(props)
{
    useEffect(() => {document.title = 'Withdraw funds';}, []);
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
                                <form className="left" action="withdraw" method="post">
                                    Deposit amount: <input type="number" name="amount" step="0.01" /><br />
                                    <input type="submit" value="Withdraw" className="button" />
                                </form>
                            </div>
                            )})}
                    </main>
                </div>
            </>
        );
}

export default WithdrawFunds;