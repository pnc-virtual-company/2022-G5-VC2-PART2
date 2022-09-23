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
                    onselectstart="return false"
                    oncut="return false"
                    oncopy="return false"
                    onpaste="return false"
                    ondrag="return false"
                    ondrop="return false"
                    v-model="newPassword">
                </div>
                <div class="confrim mb-4 relative">
                    <h1>Confirm password</h1>
                    <input class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded bg-white border-solid focus:outline-blue-500 focus:shadow-outline border-b-1.5" :class="{'bg-red-100 border border-red-500':is_fill_confirm_password,messageNotConfirm}" 
                    :type="type" id="confirm-password" placeholder="Enter a password ..." 
                    @input="is_fill_confirm_password = false"
                    v-model="confirmPassword" >
                    <svg v-if="type=='password'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute top-[40px] right-3 text-gray-400 hover:cursor-pointer" @click="checkVisibility" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute top-[40px] right-3 text-gray-400 hover:cursor-pointer" @click="checkVisibility" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    </svg>
                    <p class="text-sm">{{messageNotConfirm}}</p>
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