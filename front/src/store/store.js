import { createStore } from 'vuex'

export const store = new createStore({
  state: {
    // role: decryptData(getCookie('role'), 'my_role'),
    // token: decryptData(getCookie('token'), 'my_token'),
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
