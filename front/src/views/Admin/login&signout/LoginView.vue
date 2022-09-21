<template>
  <div>
        <alert-success v-if="isCreatedPassword" :content="message"> </alert-success>
      <div class="w-full m-auto h-[100vh] flex items-center justify-center p-4">
        <div class="p-5 uppercase w-[50%] ">
          <img src="../../../assets/pic-login.png" alt="" class="w-[100%] m-auto" />
        </div>
          <create-password v-if="isPasswordNull" @create-password="createPassword"></create-password>
          <set-password v-else-if="isPasswordNotNull"></set-password>
          <login-form v-else @confirm-email="handleLogin" ></login-form>
      </div>  
  </div>
</template>

<script>
    import LoginForm from "../../../components/login/ConfirmEmailLogIn.vue"
    import createPassword from "../../../components/login/CreatePassword.vue"
    import setPassword from "../../../components/login/SetPasswordLogin.vue"
    import alertSucess from "@/components/widgets/AlertSuccess.vue"
    export default {
      components: {
        'login-form':LoginForm,
        'create-password':createPassword,
        'set-password': setPassword,
        'alert-success': alertSucess,
      },
      data(){
        return {
          isPasswordNull: false,
          isPasswordNotNull: false,
          isCreatedPassword: false,
          message: "Password created successfull",
        }
      },
      methods: {
        handleLogin(response){
          if (!response.password_status){
            this.isPasswordNull = true;
          } else {
            this.isPasswordNotNull = true;
          }
        },
        createPassword(){
            this.isPasswordNotNull=true;
            this.isPasswordNull=false;
            this.isCreatedPassword = true;
            this.successAlert()
        },
        successAlert() {
            this.isCreatedPassword = true;
            setTimeout(() => {
                this.isCreatedPassword = false;
            }, 4000);
        },
      }
    }
</script>