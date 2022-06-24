import Top from "./Top";
import AccountBar from "./AccountBar";
import NavBar from "./NavBar";
import Messages from "./Messages";
import {useState, useEffect} from 'react';

function Accounts(props)
{
    useEffect(() => {document.title = 'Account';}, []);

    const [loggedIn, setLoggedIn] = useState(false);
    const [fullName, setFullName] = useState('');
    const [accounts, setAccounts] = useState([]);
    useEffect(() => {setAccounts ([{'fname' : 'Lunar', 'lname' : 'Biscuit', 'email' : 'lunar@biscuit.com', 'pnumber' : '42069', 'anumber' : '1337', 'funds' : 420.69}])}, []);

    if (accounts.length === 0)
        return (
            <>
                <Top />
                <AccountBar loggedIn={loggedIn} fullName={fullName} />
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
                <AccountBar loggedIn={loggedIn} fullName={fullName} />
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