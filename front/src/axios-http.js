import axios from "axios";
import aesDecryptData from "./secret/aesdecrypt";
import getDataCookie from "./secret/getDataCookie";
export default axios.create({
  baseURL: process.env.VUE_APP_API_URL,
  headers: {
    "Content-type": "application/json",
    'Authorization': 'Bearer ' + aesDecryptData(getDataCookie('token'), 'my_token'),
  }
});