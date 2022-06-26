function AccountBar(props)
{
    if (props.loggedIn === true)
    {
        return (
            <div  className="accountBar">
                <div className="contentBox">
                    <a className="navLink" href="accounts">{props.fullName}</a>
                </div>
                <div className="contentBox">
                    <form action="logout" method="post">
                        <button className="logout" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        );
    }

    return (
        <>
            <div  className="accountBar">
                <div className="contentBox">
                    <a className="navLink" href="login">Login</a>
                </div>
                <div className="contentBox">
                    <a className="navLink" href="account-creation-form">Register</a>
                </div>
            </div>
        </>
    );
}

export default AccountBar;