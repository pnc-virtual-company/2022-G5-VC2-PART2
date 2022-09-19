import CryptoJS from "crypto-js"

function aesEncrypt(data,secret) {
        return CryptoJS.AES.encrypt(data,secret).toString();
}

export default aesEncrypt;