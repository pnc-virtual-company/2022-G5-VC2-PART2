<template>
  <div class="bg-blue-500 w-full fixed top-0 z-50">
    <nav class="flex w-full p-2 text-white justify-between items-center px-4">
      <ul>
        <li>
          <img src="../assets/logo.png" alt="logo" class="w-[50px] ">
        </li>
      </ul>
      <div class="flex">
        <ul>
          <li>
            <router-link class="p-2 px-6 active:bg-orange-700" to="/dashboard">Dashboard</router-link>
          </li>
        </ul>
        <ul>
          <li>
            <router-link class="p-2 px-6" to="/followUp">FollowUp</router-link>
            <div class="ml-3 items-center absolute left-[48vw] top-[10px]">
                            <small class="bg-red-400 text-white rounded-lg px-[0.30rem] border">1</small>
                        </div>
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
                      <router-link class="p-2 px-6" to="/profile">coordinator</router-link>
                      <div class="w-15 h-15 ml-2">
                          <img  src="../assets/avatar.png" alt="" class=" w-[50px] h-[50px] rounded-full">
                      </div>
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
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
/* nav a.router-link-exact-active {
  background: orange;
  border-radius:4px;
} */
</style>