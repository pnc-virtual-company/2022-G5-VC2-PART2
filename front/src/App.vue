<template>
  <div>
    <navbar-view v-if="isLogin" :user="user"/>
    <router-view v-slot="{ Component }" >
      <transition name="fade" :user="user">
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
    async findUserInfo(){
      if(this.$store.state.authenticated){
        this.isLogin = true;
          await axios.get('account/find').then((res)=>{
            this.user = res.data;
            localStorage.setItem('userId', this.user.id);
            if (this.user == null){
                this.$store.dispatch('logout')
                this.$router.push('/login')
            }
            this.isLogin = true;
            if (this.user.roles === 'STUDENT') {
              localStorage.setItem('userId',this.user.student_id);
            }else{
              localStorage.setItem('userId',this.user.id);
            }
            localStorage.setItem('role',this.user.roles);
          });
      }
    }
  },
  async created(){
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