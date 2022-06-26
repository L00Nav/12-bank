function NavBar()
{
    return(
        <nav  className="navBlock contentBox">
            <a href="accounts" className="navLink">Account</a>
            <a href="account-creation-form" className="navLink">Open a new account</a>
            <a href="add-funds" className="navLink">Add funds</a>
            <a href="withdraw-funds" className="navLink">Withdraw funds</a>
        </nav>
    );
}

export default NavBar;