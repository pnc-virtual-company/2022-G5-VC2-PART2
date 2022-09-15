import { createStore } from 'vuex'
// import getCookie from "./cookie"
export const store = new createStore({
  state: {
    // role: decryptData(getCookie('role'), 'my_role'),
    // token: getCookie('token'), 'my_token',
    userId: null,
    userEmail: null,
  },
  getters: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
  }
})
