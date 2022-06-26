import {useState, useEffect} from 'react';
import axios from 'axios';

function Messages()
{
    const [messages, setMessages] = useState([]);
    useEffect(() => {
        axios.get('http://omnicorp.bank.gov/api/messages')
        .then(res => {
            setMessages(res.data)
        })
    }, []);

    return (
        <>
            <div className="messageBox">
                {messages.map((message, index) => {
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