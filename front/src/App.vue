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

</style>