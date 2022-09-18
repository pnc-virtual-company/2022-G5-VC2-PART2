<template>
  <div>
    <navbar-view v-if="isLogin" />
    <router-view v-slot="{ Component }">
      <transition name="fade">
        <component :is="Component" />
      </transition>
    </router-view>
  </div>
</template>
<script>
import NavBar from "./components/navigation/NavbarView.vue";
import FormLogin from './views/Admin/login&signout/LoginView.vue'
import axios from "./axios-http"
export default {
  components: {
    "navbar-view": NavBar,
    "form-login" : FormLogin,
  },
  data(){
    return {
      isLogin: false
    }
  },
  methods: {
    findUserInfo(){
      axios.get('account/find').then((res)=>{
        console.log(res.data);
      })
      if (this.$store.state.authenticated){
        this.isLogin = true;
        this.$router.push('/');
      }else{
        this.$router.push('/login')
      }
    }
  },
  created(){
    this.findUserInfo()
  }
};
</script>
<style>
#app {
  font-family: sans-serif;
}
body{
  background: #eee;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateX(50px);
}
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s ease-out;
}
</style>
