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
export default {
  components: {
    "navbar-view": NavBar,
  },
  data(){
    return {
      isLogin: false
    }
  },
  methods: {
    findUserInfo(){
      console.log(this.$store.state.authenticated);
      if (this.$store.state.authenticated){
        this.isLogin = true;
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
