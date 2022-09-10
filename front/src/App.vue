<template>
  <navbar-view/>
  <router-view/>
</template>
<script>
import NavBar from './components/NavbarView.vue'
export default {
components:{
  'navbar-view':NavBar
}
}
</script>
<style>
 #app {
  font-family: sans-serif;
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
