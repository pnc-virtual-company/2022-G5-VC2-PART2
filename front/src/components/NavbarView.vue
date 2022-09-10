<template>
  <div class="bg-blue-500 w-full fixed top-0 z-50">
    <nav class="flex w-full text-white justify-between items-center px-4">
      <ul>
        <li>
          <img src="../assets/logo.png" alt="logo" class="w-[40px] ">
        </li>
      </ul>
      <div class="flex">
        <ul>
          <li>
            <router-link class="p-2 px-6" to="/dashboard">Dashboard</router-link>
          </li>
        </ul>
        <ul>
          <li>
            <router-link class="p-2 px-6" to="/followUp">FollowUp</router-link>
          </li>
        </ul>
        <ul>
          <li>
            <router-link class="p-2 px-6" to="/people">People</router-link>
          </li>
        </ul>
      </div>
      <li @click="show=!show" class="flex flex-col items-end min-w-[9rem] space-x-2 cursor-pointer">
                    <div class="flex justify-center items-center">
                      <span >coordinator</span>
                      <div class="w-15 h-15 ml-2">
                          <img  src="../assets/avatar.png" alt="" class=" w-[50px] h-[50px] rounded-full">
                      </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <div v-if="show" class="py-1 rounded-md shadow-xs absolute bg-gray-200 mt-10 right-0">
                        <router-link class="flex px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-warning hover:text-white focus:outline-none focus:bg-gray-100" :to="role =='admin'?'/admin':'/profile'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Your Profile
                        </router-link>
                        <div class="flex px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out focus:outline-none hover:bg-warning hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Sign out
                        </div>
                    </div>
                </li>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
        return {
            show: false,
        };
    },
}
</script>

<style>

</style>