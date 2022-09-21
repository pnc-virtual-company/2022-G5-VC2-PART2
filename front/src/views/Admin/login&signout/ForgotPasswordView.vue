<template>
    <div>
        <verify-Form v-if="isVerificated" :email="email"></verify-Form>
        <forgot-form v-else @verify-code="verifyCode"></forgot-form>
    </div>
</template>

<script >
    import forgotForm from "../../../components/login/FindEmailAddress.vue"
    import verifyForm from "../../../components/login/FormVerificationCode.vue"
export default({
    components: {
        'forgot-form': forgotForm,
        'verify-Form': verifyForm,
    },
    data(){
        return {
            isVerificated: false,
            email: ''
        }
    },
    methods: {
        verifyCode(email){
            this.email = email;
            this.isVerificated = true;
        }   
    }
})
</script>
