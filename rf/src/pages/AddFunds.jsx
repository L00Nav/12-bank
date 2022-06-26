import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useState, useEffect} from 'react';

function AddFunds(props)
{
    useEffect(() => {document.title = 'Add funds';}, []);

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
                        There are no funds to add...
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
                                {account.lname} {account.fname}<br />
                                {account.funds} €<hr /><br />
                                <form className="left" action="deposit" method="post">
                                    Deposit amount: <input type="number" name="amount" step="0.01" /><br />
                                    <input type="submit" value="Deposit" className="button" />
                                </form>
                            </div>
                            )})}
                    </main>
                </div>
            </>
        );
}

export default AddFunds;