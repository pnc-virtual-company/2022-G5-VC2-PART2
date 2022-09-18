<template>
  <div class="bg-primary w-full fixed top-0 z-50">
    <nav class="flex w-full p-2 text-white justify-between items-center px-4">
      <ul>
        <li>
          <img src="../../assets/logo.png" alt="logo" class="w-[50px]" />
        </li>
      </ul>
      <ul class="flex">
        <li>
          <router-link
            class="p-3 px-6"
            exact-active-class="exact-active-link"
            to="/dashboard"
            >Dashboard</router-link
          >
        </li>
        <li>
          <router-link
            class="p-3 px-6"
            exact-active-class="exact-active-link"
            to="/teacher"
            >All Teachers</router-link
          >
        </li>
        <li>
          <router-link
            class="p-3 px-6"
            exact-active-class="exact-active-link"
            to="/student"
            >All Students</router-link
          >
        </li>
        <li class="relative">
          <router-link class="p-3 px-6" exact-active-class="exact-active-link" to="/followUp">Follow Up</router-link>
          <div class="ml-3 items-center absolute right-0 -top-2">
            <div class="bg-red-400 text-white rounded-full p-2 flex items-center justify-center w-5  h-5 "><small>1 </small></div>
          </div>
        </li>
      </ul>

      <li
        @click="show = !show"
        class="flex flex-col items-end min-w-[9rem] space-x-2 cursor-pointer"
      >
        <div class="flex justify-center items-center">
          <router-link class="p-2 flex items-center" to="/profile">coordinator
              <img src="../../assets/avatar.png" alt="" class=" w-8 h-8 rounded-full">
          </router-link>
          <div class="group">
            <svg
              @click="handleLogout"
              xmlns="http://www.w3.org/2000/svg"
              class="h-10 w-10 mr-1 p-2"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
              />
            </svg>
            <div
              id="logout"
              class="add-button absolute z-50 hidden group-hover:block right-2 top-14 text-md w-20 bg-[#19afd8] rounded-full text-white p-1.5 text-center">
              Logout
            </div>
          </div>
        </div>
      </li>
    </nav>
    <loading-logout v-if="isLogout"></loading-logout>
  </div>
</template>

<script>
import loadingLogout from "../animations/LoadingAnimate.vue"
export default {
  components: {
    'loading-logout': loadingLogout
  },
  props: {
    user: Object
  },
  data() {
    return {
      show: false,
      isLogout: false
    };
  },
  methods: {
    handleLogout(){
      this.isLogout = true;
      setTimeout(() => {
          this.isLogout = false;
          window.location.reload();
          this.$store.dispatch('logout');
          this.$router.push('/login');
      }, 1000);
    }
  },
  created(){
    console.log(this.user);
  }
};
</script>

<style>
.exact-active-link {
  background: #FF6B00;
}
li a:hover {
  background: rgba(228, 228, 228, 0.74);
  transition: 2s;
  transform: ease-in-out;
}
#logout::before{
  background: #19afd8;
  left: 40px;
  top: -4px;
}
</style>
