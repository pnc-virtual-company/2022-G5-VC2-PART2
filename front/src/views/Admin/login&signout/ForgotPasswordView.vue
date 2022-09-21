<template>
      <div class="w-full m-auto h-[100vh] flex items-center justify-center p-4">
        <div class="p-5 uppercase w-[50%] ">
          <img src="../../../assets/forgot-password.png" alt="" class="w-[100%] m-auto" />
        </div>
        <verify-Form v-if="isVerificated" :email="email" @confirmed-code="isVerified=true"></verify-Form>
        <forgot-form v-else @verify-code="verifyCode"></forgot-form>
        <div class="w-full h-full bg-black z-50 bg-opacity-30 flex items-center justify-center fixed top-0" v-if="isVerified">
            <create-password ></create-password>
        </div>
      </div>  
</template>

<script>
    import createPassword from "../../../components/login/CreatePassword.vue"
    import forgotForm from "../../../components/login/FindEmailAddress.vue"
    import verifyForm from "../../../components/login/FormVerificationCode.vue"
    export default({
        components: {
            'forgot-form': forgotForm,
            'verify-Form': verifyForm,
            'create-password':createPassword,
        },
        data(){
            return {
                isVerificated: false,
                email: '',
                isVerified: false,
            }
        },
        methods: {
            verifyCode(email){
                this.email = email;
                this.isVerificated = true;
            },
        }
    })
</script>
