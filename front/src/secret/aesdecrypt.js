import CryptoJS from 'crypto-js';

function aesDecryptData(data, secretKey){
    if(data!==undefined){
        return CryptoJS.AES.decrypt(data, secretKey).toString(CryptoJS.enc.Utf8);
    }
}

export default aesDecryptData;
