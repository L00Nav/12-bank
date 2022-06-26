import Top from "../Components/Top";
import AccountBar from "../Components/AccountBar";
import NavBar from "../Components/NavBar";
import Messages from "../Components/Messages";
import {useEffect} from 'react';

function FourOhFour()
{
    useEffect(() => {document.title = 'Page not found';}, []);

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
                </main>
            </div>
        </>
    );
}

export default FourOhFour;