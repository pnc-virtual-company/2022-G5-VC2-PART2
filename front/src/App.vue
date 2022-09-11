<template>
  <navbar-view />
  <router-view v-slot="{ Component }">
    <transition name="fade">
      <component :is="Component" />
    </transition>
  </router-view>
</template>
<script>
import NavBar from "./components/navigation/NavbarView.vue";
export default {
  components: {
    "navbar-view": NavBar,
  },
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
/*nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
} */

/* nav a.router-link-exact-active {
  color: #42b983;
} */
</style>
