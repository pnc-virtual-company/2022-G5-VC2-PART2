<template>
    <div class="flex items-center justify-center w-[40%]">
      <form class="w-full m-auto p-4 rounded shadow  px-12" @submit.prevent="handleFindAddress">
        <h1 class="text-xl font-semibold text-center p-1 uppercase mt-6 text-primary border-b-2">
            Find Email Address
        </h1>
        <div class="mb-1 relative mt-5">
            <div>
                <h1 class="text-lg">Please enter your email to search for your account.</h1>
            </div>
          <div class="flex items-center relative mt-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9   p-2 h-9   absolute text-primary border-r-2 top-0.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
              <input
                class="appearance-none bg-gray-100 rounded w-full px-2 py-3 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline pl-10 border-b-2 border-primary"
                :class="{'border-red-500 bg-red-100':is_empty}"
                type="email"
                id="email"
                placeholder="Email your email ..."
                v-model="email"
                @input="is_empty=false,s_not_found_mail = false"
              />
          </div>
        </div>
        <div class="text-red-500 text-sm" v-if="is_not_found_mail">This email doesn't exist!</div>
        <div class="flex items-center justify-end mt-12">
            <button-create>
              <template v-slot:button_create>Find mail</template>      
            </button-create>
        </div>
      </form>
    </div>


</template>

<script>
  import axios from "../../axios-http"
  export default ({
    emits: ['verify-code'],
    data(){
      return {
        is_empty: false,
        email: ''
      }
    },

    methods: {
      handleFindAddress(){
        if (this.email.trim() != ""){
          axios.post('/forgot/findMail', {email:this.email}).then((res)=>{
            if (res.data.status){
              this.$emit('verify-code',this.email);
            }else{
              this.is_empty = true;
              this.is_not_found_mail = true;
            }
          })
        }else{
          this.is_empty = true;
        }
      }
    },
    created(){
      axios.post('/forgot/findMail', {email:this.$store.state.userEmail});
    }
  })
</script>
