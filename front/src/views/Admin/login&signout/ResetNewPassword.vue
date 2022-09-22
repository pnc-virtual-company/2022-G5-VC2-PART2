<template>
    <div class="w-full m-auto h-[100vh] flex items-center justify-center p-4 bg-black bg-opacity-40 fixed top-0">
        <form @submit.prevent="onSavePassword" class="w-[40%] items-center justify-center p-3 bg-slate-100 rounded shadow ">
            <div class="current mb-4 relative">
                <h1>Current Password *</h1>
                <input class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded shadow bg-white border-solid focus:outline-blue-500 focus:shadow-outline border-b-1.5" :type="type" id="current-password" placeholder="Enter a password ..." v-model="currentPassword">
                <p>{{currentPasswordWorng}}</p>
            </div>
            <div class="new mb-4 relative">
                <h1>New Password *</h1>
                <input class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded shadow bg-white border-solid focus:outline-blue-500 focus:shadow-outline border-b-1.5" :type="type" id="new-password" placeholder="Enter a password ..." v-model="newPassword">
            </div>
            <div class="confrim mb-4 relative">
                <h1>Confirm password *</h1>
                <input class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded shadow bg-white border-solid border-b-1.5" :type="type" id="confirm-password" placeholder="Enter a password ..." v-model="confirmPassword" :class="{'border-red-500' :messageNotConfirm}">
                <p>{{messageNotConfirm}}</p>
            </div>
            <div class="mb-4 relative">
                <input type="checkbox" id="show" @click="checkVisibility">
                <label for="show"> Show password </label>
            </div>
            <div class="flex items-center justify-end">
                <button-cancel @click="$emit('closeForm')">
                    <template v-slot:button_cancel>Cancel</template>     
                </button-cancel>
                <button-create>
                    <template v-slot:button_create>Save</template>      
                </button-create>
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
            currentPassword: null,
            newPassword: null,
            confirmPassword: null,
            messageSuccess: '',
            messageNotConfirm: '',
            currentPasswordWorng: '',
            type:'password'
        }
    },
    methods: {
        onSavePassword(){
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