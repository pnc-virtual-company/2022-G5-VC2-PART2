<template>
    <div class="flex items-center justify-center w-[40%]">
      <form class="w-full m-auto p-4 rounded bg-gray-100 px-12 shadow" @submit.prevent="handleSubmit">
        <h1 class="text-xl font-semibold text-center p-1 uppercase mt-6 text-primary border-b">
            Enter Security Code
        </h1>
        <div class="mb-1 relative mt-5">
            <div>
                <h1 class="text-lg">Please check your email for a message with your code. Your code is 6 number long.</h1>
            </div>
          <div class="flex items-center relative mt-12">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9   p-2 h-9   absolute text-primary border-r-2 top-0.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
              <input
                class="appearance-none bg-gray-100 rounded w-full px-2 py-3 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline pl-10 border-b-2 border-primary"
                :class="{'border-red-500 bg-red-100':is_empty}"
                type="text"
                placeholder="Email your code ..."
                v-model="code"
                @input="is_empty=false"
                maxlength="6"
              />
          </div>
        </div>
        <div class="text-red-500 text-sm" v-if="is_not_found_code">Not match the verification code</div>
        <div class="flex items-center justify-end mt-12">
            <button-create>
              <template v-slot:button_create>Submit</template>      
            </button-create>
        </div>
      </form>
    </div>


</template>

<script>
  import axios from "../../axios-http"
  export default ({
    emits: ['confirmed-code'],
    props: {
      email: String
    },
    data(){
      return {
        is_empty: false,
        code:   ''
      }
    },

    methods: {
      handleSubmit(){
        if (this.code.trim() != ''){
          console.log(this.code);
          console.log(this.email);
          axios.post('forgot/confirmCode', {code:this.code,email:this.$store.state.userEmail}).then((res)=>{
            if (res.data.status){
              this.$emit('confirmed-code');
            }else{
              this.is_empty = true;
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
