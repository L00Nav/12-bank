function Messages(props)
{
    if (typeof props.messages === 'undefined')
        return null;

    if (props.messages.length === 0)
        return null;

    return (
        <>
            <div className="messageBox">
                {props.messages.map((message, index) => {
                    return (
                        <div key={index} className="contentBox">
                            <div className={message.type}>
                                <span className="messageSymbol">
                                    {message.type === 'success' ? '✓ ' : ''}
                                    {message.type === 'alert' ? '✕ ' : ''}
                                </span>
                                {message.msg}
                            </div>
                        </div>
                    )
                })}
                
            </div>
        </>
    );
}

export default Messages;