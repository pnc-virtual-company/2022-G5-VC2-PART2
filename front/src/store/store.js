import { createStore } from 'vuex'
import getDataCookie from "@/secret/getDataCookie"
import aesDecrypt from '@/secret/aesdecrypt'
// import aesEncrypt from '@/secret/aesEncrypt'
import axios from '../axios-http'
// import { useCookies } from "vue3-cookies"
export const store = new createStore({
  state: {
    authenticated: aesDecrypt(getDataCookie('token'), 'my_token'),
    role: aesDecrypt(getDataCookie('role'), 'my_role'),
    userEmail: null,
    userId: null
  },
  actions: {
    logout(){
      document.cookie = `${'token'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      document.cookie = `${'role'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      axios.get('logout')
    }
  },
  mutations: {
    confirmEmail(state,data){
      state.userEmail = data.email;
      state.userId = data.id;
    },
  }
})
