<template>
<div>

        <alert-success v-if="isCreatedPassword" :content="message"> </alert-success>
    <div class="w-full m-auto h-[100vh] flex items-center justify-center p-4">
        <div class="p-5 uppercase w-[50%] ">
            <img src="../../../assets/forgot-password.png" alt="" class="w-[100%] m-auto" />
        </div>
        <verify-Form v-if="isVerificated" :email="email" @confirmed-code="isVerified=true"></verify-Form>
        <div class="w-full h-full bg-black z-50 bg-opacity-30 flex items-center justify-center fixed top-0" v-if="isVerified">
            <create-password @create-password="successAlert"></create-password>
        </div>
    </div>  
</div>
</template>

<script>
    import createPassword from "../../../components/login/CreatePassword.vue"
    import verifyForm from "../../../components/login/FormVerificationCode.vue"
    import alertSucess from "@/components/widgets/AlertSuccess.vue"
    export default({
        components: {
            'alert-success': alertSucess,
            'verify-Form': verifyForm,
            'create-password':createPassword,
        },
        data(){
            return {
                isVerificated: true,
                email: '',
                isVerified: false,
                isCreatedPassword: false,
                message: "Password created successful"
            }
        },
        methods: {
            verifyCode(email){
                this.email = email;
                this.isVerificated = true;
            },

            successAlert() {
                this.isCreatedPassword = true;
                setTimeout(() => {
                    this.$router.push('/login');
                    this.isCreatedPassword = false;
                }, 1000);
            },
        }
    })
</script>
