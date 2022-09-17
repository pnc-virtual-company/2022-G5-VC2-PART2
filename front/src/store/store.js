import { createStore } from 'vuex'
import getDataCookie from "@/secret/getDataCookie"
import aesDecrypt from '@/secret/aesdecrypt'
import axios from '../axios-http'
export const store = new createStore({
  state: {
    authenticated: aesDecrypt(getDataCookie('token'), 'my_token'),
    userEmail: null,
    userId: null
  },
  getters: {
  },
  mutations: {
  },
  actions: {
    logout(){
      document.cookie = `${'token'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      document.cookie = `${'id'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      document.cookie = `${'email'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      axios.get('logout')
    }
  },
  modules: {
  }
})
