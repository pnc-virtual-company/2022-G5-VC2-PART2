<template>
  <div class="w-full m-auto h-[100vh] flex items-center justify-center">
    <div class="flex items-center justify-center w-[60%]">
      <div class="p-5 uppercase w-[50%]">
        <div>
          <h1 class="text-2xl font-semibold text-primary">Student follow up</h1>
          <span class="text-lg font-semibold text-primary"> Management System </span>
        </div>
        <img src="../../assets/pic-login.png" alt="" class="w-[100%] m-auto" />
      </div>
      <form class="w-[50%]" @submit.prevent="handleLogin">
        <img src="../../assets/people.png" alt="" class="m-auto">
        <h1 class="text-lg font-semibold text-center p-1 uppercase mt-6 text-primary">
          Sign in now
        </h1>
        <div class="mb-1 relative mt-5">
          <label class="block text-gray-700 text-md" for="email"></label>
          <input
            class="appearance border w-full py-2 px-4 text-gray-700 mb-1 focus:outline-none rounded shadow"
            type="email"
            id="email"
            placeholder="Email ..."
            v-model="email"
          />
        </div>
        <div class="text-red-500 text-sm">{{email_error}}</div>
        <div class="flex items-center justify-end mt-12">
          <button
            class="flex bg-blue-500 ground  hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-primary focus:shadow-outline uppercase shadow"
            type="submit"
          >
            sign in
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6 ml-2 duration-200 ease-out"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
              />
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from '../../axios-http'
export default ({
    data(){
        return {
            email: "",
            is_empty: false,
            email_error: '',
        }
    },
    methods: {
        async handleLogin(){
            if (this.email.trim() != ""){
                await axios.post('/login',{email: this.email}).then((res)=>{
                    const reponse = res.data;
                    this.is_empty = false;
                    this.email_error = ""
                    console.log(reponse);
                    if (reponse.email !=null){
                      this.$store.state.userEmail =  reponse.email;
                      // this.$cookie.set('token',reponse.token);
                      if (reponse.password == null){
                          this.$router.push('/createPassword');
                      } else {
                          this.$router.push('/setPassword')
                      }
                    }else{
                      this.is_empty = true;
                      this.email_error = "This email doesn't exist!"
                    }
                })
            }else{
                this.is_empty = true
            }
        }
    }
})
</script>
