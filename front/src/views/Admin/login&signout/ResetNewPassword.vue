<template>
    <div class="w-full m-auto h-[100vh] flex items-center justify-center p-4 bg-black bg-opacity-40 fixed top-0">
        <form @submit.prevent="onSavePassword" class="w-[40%] bg-slate-100 rounded shadow ">
            <h1 class="p-2 text-center bg-primary text-white text-xl rounded-t">Reset New Password</h1>
            <div class="p-4">
                <div class="current mb-4 relative">
                    <h1>Current Password</h1>
                    <input 
                        class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded bg-white border-solid focus:outline-blue-500 focus:shadow-outline border-b-1.5" 
                        :class="{'bg-red-100 border border-red-500':is_fill_current_password}"
                        type="password"
                        placeholder="Enter a password ..."
                        @input="is_fill_current_password = false,currentPasswordWorng=''"
                        v-model="currentPassword">
                    <p class="text-sm">{{currentPasswordWorng}}</p>
                </div>
                <div class="new mb-4 relative">
                    <h1>New Password</h1>
                    <input 
                    class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded bg-white border-solid focus:outline-blue-500 focus:shadow-outline border-b-1.5" 
                    :class="{'bg-red-100 border border-red-500':is_fill_new_password}"
                    type="password" 
                    placeholder="Enter a password ..." 
                    @input="is_fill_new_password = false"
                    v-model="newPassword">
                </div>
                <div class="confrim mb-4 relative">
                    <h1>Confirm password</h1>
                    <input class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded bg-white border-solid focus:outline-blue-500 focus:shadow-outline border-b-1.5" :class="{'bg-red-100 border border-red-500':is_fill_confirm_password,messageNotConfirm}" 
                    :type="type" id="confirm-password" placeholder="Enter a password ..." 
                    @input="is_fill_confirm_password = false"
                    v-model="confirmPassword" >
                    <p class="text-sm">{{messageNotConfirm}}</p>
                </div>
                <div class="mb-4 relative text-sm flex items-center">
                    <input type="checkbox" id="show" @click="checkVisibility">
                    <label for="show" class="ml-2"> Show password </label>
                </div>
                <div class="flex items-center justify-end">
                    <button-cancel @click="$emit('closeForm')">
                        <template v-slot:button_cancel>Cancel</template>     
                    </button-cancel>
                    <button-create>
                        <template v-slot:button_create>Save</template>      
                    </button-create>
                </div>
            </div>
            
        </form>
    </div>
</template>

<script>
import axios from '../../../axios-http';
export default ({
    emits: ['button_cancel'],
    props:{
        userId:Number,
    },
    data() {
        return {
            currentPassword: '',
            newPassword: '',
            confirmPassword: '',
            messageSuccess: '',
            messageNotConfirm: '',
            currentPasswordWorng: '',
            type:'password',
            is_fill_new_password:false,
            is_fill_confirm_password:false,
            is_fill_current_password:false
        }
    },
    methods: {
        onSavePassword(){
            if (this.checkFormValidation()){
                let newPasswordReset = {
                    currentPassword: this.currentPassword,
                    newPassword: this.newPassword,
                    confirmPassword: this.confirmPassword,
                }
                axios.post('/users/reset-password/' + this.userId, newPasswordReset).then(((res)=> {
                    this.$emit('success',res.data.message);
                })).catch((error) =>{
                    if(error.response.status === 402) {
                        this.messageNotConfirm = error.response.data.message;
                    }else if (error.response.status === 401) {
                        this.currentPasswordWorng = error.response.data.message;
                    }
                });
            }
        },
        checkFormValidation(){
            if (this.newPassword.trim() == ""){
                this.is_fill_new_password = true
            }
            if (this.currentPassword.trim() == ""){
                this.is_fill_current_password = true
            }
            if (this.confirmPassword.trim() == ""){
                this.is_fill_confirm_password = true
            }
            var message = true;
            if ( this.is_fill_new_password || this.is_fill_confirm_password || this.is_fill_current_password ){
                message =  false;
            }
            return message
        },
        checkVisibility() {
            if (this.type == 'password') {
                this.type = 'text';
            }else{
                this.type = 'password';
            }
        }

    },
})
</script>
<style scoped>
    p{
        margin: 0;
        padding: 0;
        color: red;
    }
</style>