<template>
    <create-password />
</template>

<script>
    import createPassword from "../../../components/login/CreatePassword.vue"
    export default {
        components: {
            'create-password':createPassword
       }
        
    }
</script>