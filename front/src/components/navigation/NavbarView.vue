<template>
  <div class="bg-primary w-full fixed top-0 z-50 shadow">
    <nav class="flex w-full p-2 text-white justify-between items-center px-4">
      <ul>
        <li>
          <img src="../../assets/logo.png" alt="logo" class="w-[50px]" />
        </li>
      </ul>
      <ul class="flex">
        <li v-if="user.roles == 'Coordinator'">
          <router-link
            class="p-3 px-6"
            exact-active-class="exact-active-link"
            to="/dashboard"
            >Dashboard</router-link
          >
        </li>
        <li v-if="user.roles == 'Coordinator'">
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
      <ul>

      <li
        @click="show = !show"
        class="flex mr-4 items-center justify-end min-w-[9rem] space-x-2 cursor-pointer"
      >
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
          </svg>
        <div class="flex justify-center items-center" @click="isClickShow=!isClickShow">
          <!-- {{user.first_name}} {{user.last_name}} -->
          <img :src="getProfile(user.profile)" alt="" class=" w-10 ml-2 mr-1 h-10 rounded-full ">
          <svg v-if="!isClickShow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
          </svg>

          <div id="card" class="bg-[#ffffff]  ease-in-out duration-500 rounded shadow absolute right-2 top-16 text-primary w-40 p-2" v-if="isClickShow">
              <router-link to="/profile" class="flex items-center p-2 px-2 hover:bg-blue-200 ease-in-out duration-300 rounded " >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                View Profile
              </router-link >
              <li class="flex items-center p-2 px-2 hover:bg-blue-200 ease-in-out duration-300 rounded" @click="handleLogout">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 mr-2 "
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
                Logout
              </li>
          </div>
        </div>
      </li>

    </nav>
    <loading-logout v-if="isLogout"></loading-logout>
  </div>
</template>

<script>
import loadingLogout from "../animations/LoadingAnimate.vue"
import axios from "../../axios-http"
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
      isLogout: false,
      isClickShow: false,
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
      }, 500);
    },
    getProfile(image) {
      return axios.defaults.baseURL + "storage/image/" + image;
    },
  },
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

#card::before{
  position: absolute;
  content: "";
  height: 14px;
  width: 14px;
  background: #ffffff;
  left: 80px;
  top: -7px;
  transform: translateX(-50%) rotate(45deg);
}
</style>
