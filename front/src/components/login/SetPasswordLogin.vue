<template>
    <div class="flex items-center justify-center w-[40%] ease-in-out duration-400 ">
          <form class="w-full m-auto p-4 rounded bg-gray-100 px-12" @submit.prevent="handleLogin">
            <div class="w-full m-auto p-4 rounded bg-gray-100 px-12">
              <div class="text-center text-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 p-4 border-4 border-primary h-28 bg-gray-100  shadow rounded-full m-auto">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                  </svg>
                  <h1 class=" text-xl mt-2 font-bold">Enter Password</h1>
              </div>
              <div class="mb-1   relative mt-6">
                <div class="flex items-center relative">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9   p-2 h-9   absolute text-primary border-r-2 top-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                  </svg>
                  <input
                    class=" appearance-none bg-gray-100  rounded w-full px-2 py-3 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline pl-10 border-b-2 border-primary"
                    :class="{' border-red-500 bg-red-100':isEmptyPassword}"
                    :type="type"
                    id="password"
                    placeholder="Enter your password ..."
                    v-model="inputPassword"
                    @input="isEmptyPassword=false,isIncorrect=false"
                  />
                </div>
              </div>
              <div v-if="isIncorrect" class="text-red-400 text-sm mb-2">Incorrect password</div>  
              <div class="mb-6 relative text-sm">
                <input type="checkbox" id="show" @click="check">
                <label for="show"> Show password </label>
              </div>
              <div class="flex items-center justify-between mt-8  ">
                <router-link
                  class="inline-block cursor-pointer align-baseline text-sm text-blue-500 hover:text-blue-600"
                  to="/forgot"
                >
                  Forgot Password?
                </router-link>
                  <button
                    :disabled="inputPassword==''"
                    class=" bg-blue-500 ground  hover:bg-blue-600 text-white py-1.5 px-4 rounded focus:outline-primary focus:shadow-outline  shadow"
                    :class="{'bg-gray-300 hover:bg-gray-300 hover:cursor-not-allowed': inputPassword==''}"
                    type="submit"
                  >
                      <span class="flex uppercase" v-if="isProcessing">
                          Next
                      </span>
                      <span class="flex" v-else>
                          <svg class="mr-2 w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                              <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                          </svg>
                          wait...
                      </span>
                  </button>
                </div>
            </div>
          </form>
    </div>
</template>
<script>
import axios from "../../axios-http"
import aesEncrypt from "../../secret/aesEncrypt"
export default({
  
  data(){
    return {
      type: "password",
      inputPassword: "",
      isEmptyPassword: false,
      isProcessing: true,
      isIncorrect: false,
      password_status: false
    }
  },
  methods: {
    check(){
      if (this.type == "password"){
        this.type = "text"
      }else{
        this.type = "password"  
      }
    },
    handleLogin(){
      if (this.inputPassword.trim() != ""){
        this.isEmptyPassword = false;
        this.isIncorrect = false;
        this.isProcessing = false;
        axios.post('/login',{email: this.$store.state.userEmail, password: this.inputPassword}).then(res=>{
          this.isProcessing = true;
          let data = res.data;
              console.log(data);
          if (data.password_status){
              const secret_role = aesEncrypt(data.user.roles, 'my_role');
              const secret_token = aesEncrypt(data.token, 'my_token');
              this.$cookies.set('role',secret_role);
              this.$cookies.set('token',secret_token);
              window.location.reload();
          }else{
            this.isEmptyPassword = true;
            this.isIncorrect = true;
          }
        })
      }
    },
  },
})

</script>
