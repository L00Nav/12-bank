function NavBar()
{
    return(
        <nav  className="navBlock contentBox">
            <a href="accounts" className="navLink">Account</a>
            <a href="accountCreationForm" className="navLink">Open a new account</a>
            <a href="addFunds" className="navLink">Add funds</a>
            <a href="withdrawFunds" className="navLink">Withdraw funds</a>
        </nav>
    );
}

export default NavBar;