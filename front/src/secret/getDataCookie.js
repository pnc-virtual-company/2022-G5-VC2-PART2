function getDataCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return convertCookie(decodeURIComponent(parts.pop().split(';').shift()));
}

function convertCookie(cookie){
    return cookie.replace(/%/g, '|');
}

export default getDataCookie;