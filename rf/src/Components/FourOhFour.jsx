import Top from "./Top";
import AccountBar from "./AccountBar";
import NavBar from "./NavBar";
import Messages from "./Messages";
import {useState, useEffect} from 'react';
import axios from 'axios';

function FourOhFour()
{
    useEffect(() => {document.title = 'Page not found';}, []);
    const [test, setTest] = useState('t');
    useEffect(() => {
        axios.get('http://omnicorp.bank.gov/api/test')
        .then(res => {
            console.log(res.data);
            setTest(res.data)
        })
    }, []);

    return(
        <>
            <Top />
            <AccountBar />
            <Messages />
            <div className="contentContainer">
                <NavBar />
                <main  className="mainContetBlock contentBox">
                    <h1>404 - page not found</h1>
                    <p>Something went wrong. You wouldn't be responsible for this, would you, user?</p>
                    {test}
                </main>
            </div>
        </>
    );
}

export default FourOhFour;