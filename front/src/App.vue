<template>
  <div>
    <navbar-view v-if="isLogin" :user="user"/>
    <router-view v-slot="{ Component }" >
      <transition name="fade">
        <component :is="Component" />
      </transition>
    </router-view>
  </div>
</template>
<script>
import NavBar from "./components/navigation/NavbarView.vue";
import axios from "./axios-http"
export default {
  components: {
    "navbar-view": NavBar,
  },
  data(){
    return {
      isLogin: false,
      user: {}
    }
  },
  methods: {
    findUserInfo(){
      if (this.$store.state.authenticated){
        axios.get('account/find').then((res)=>{
          let data = res.data;
            this.user = data;
            this.isLogin = true;
            this.$store.state.userId = data.id;
            this.$store.state.role = data.role;
        })
      }
    }
  },
  created(){
    this.findUserInfo();
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
