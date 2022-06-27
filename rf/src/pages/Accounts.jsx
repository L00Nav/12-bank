import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';
import axios from 'axios';

function Accounts(props)
{
    useEffect(() => {document.title = 'Account';}, []);
    
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
                        There are no accounts to display...
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
                                {account.lname} {account.fname}<br /><hr />
                                {account.email}<br />
                                {account.pnumber}<br />
                                {account.anumber}<br />
                                {account.funds} €<br /><br />
                                <div className="contentBox fundsButtonBox left">
                                    <a href="addFunds" className="navLink">Deposit</a>
                                </div>
                                <div className="contentBox fundsButtonBox left">
                                    <a href='withdrawFunds' className='navLink'>Withdraw</a>
                                </div>
                                <div className="contentBox fundsButtonBox left">
                                    <a href="addFunds" className="navLink">Delete</a>
                                </div>
                            </div>
                            )})}
                    </main>
                </div>
            </>
        );
}

export default Accounts;