let messageStorage = [];

function addM(newMessages)
{
    for (let i = 0; i < newMessages.length; i++)
    {
        messageStorage += newMessages[i];
    }
}

function getM()
{
    const output = messageStorage;
    return output;
}