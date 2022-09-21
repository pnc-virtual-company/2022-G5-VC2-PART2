<template>
  <div class="bg-primary w-full fixed top-0 z-50 shadow">
    <nav class="flex w-full p-2 text-white justify-between items-center px-4">
      <ul class="flex items-center">
        <li class="mr-16">
          <img src="../../assets/logo.png" alt="logo" class="w-[40px]" />
        </li>
          <li v-if="user.roles == 'Coordinator'">
            <router-link
              class="p-3 px-4 ml-3"
              exact-active-class="exact-active-link"
              to="/dashboard"
              >Dashboard</router-link
            >
          </li>
          <li v-if="user.roles == 'Coordinator'">
            <router-link
              class="p-3 px-4"
              exact-active-class="exact-active-link"
              to="/teacher"
              >All Teachers</router-link
            >
          </li>
          <li v-if="user.roles != 'STUDENT'">
            <router-link
              class="p-3 px-4"
              exact-active-class="exact-active-link"
              to="/student"
              >All Students</router-link
            >
          </li>
          <li class="relative">
            <router-link class="p-3 px-4" exact-active-class="exact-active-link" to="/followUp">Follow Up</router-link>
            <div class="ml-6 items-center absolute right-0 -top-3">
              <div class="bg-warning  text-white rounded-full p-1 flex items-center justify-center w-5  h-5  text-[14px]"><small>11 </small></div>
            </div>
          </li>
      </ul>
      <li
        @click="show = !show"
        class="flex mr-4 items-center justify-end min-w-[9rem] space-x-2 cursor-pointer"
      >
          <div class=" inline-flex relative w-fit">
            <div class="absolute inline-block top-0 right-0 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 p-1.5 text-xs bg-warning rounded-full z-10"></div>
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="mx-auto text-white w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                  <path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                </svg>
          </div>
        <div class="flex justify-center items-center" @click="isClickShow=!isClickShow">
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
  /* background: #FF6B00; */
  font-weight: bold;
  
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
