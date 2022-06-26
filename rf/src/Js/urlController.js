function getPage()
{
    let url = window.location.href;
    url = url.split('/');
    url = url[url.length - 1];
    url = url.charAt(0).toUpperCase() + url.slice(1);
    return url;
}

export default getPage;