<template>
    <div class="w-full m-auto h-[100vh] flex items-center justify-center p-4 bg-gray-400">
        <form @submit.prevent="onSavePassword" class="w-[40%] items-center justify-center p-3 bg-slate-100 rounded shadow">
            <div class="current mb-4 relative">
                <h1>Current Password *</h1>
                <input class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded shadow bg-white" type="password" id="current-password" placeholder="Enter a password ..." v-model="currentPassword">
            </div>
            <div class="new mb-4 relative">
                <h1>New Password *</h1>
                <input class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded shadow bg-white" type="password" id="new-password" placeholder="Enter a password ..." v-model="newPassword">
            </div>
            <div class="confrim mb-4 relative">
                <h1>Confirm password *</h1>
                <input class="appearance-none w-full px-2 py-2 text-gray-700 mb-1 rounded shadow bg-white" type="password" id="confirm-password" placeholder="Enter a password ..." v-model="confirmPassword">
            </div>
            <div class="mb-4 relative">
              <input type="checkbox" id="show">
              <label for="show"> Show password </label>
            </div>
            <div class="flex items-center justify-end">
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
    data() {
        return {
            currentPassword: null,
            newPassword: null,
            confirmPassword: null,
        }
    },
    methods: {
        save(password) {
            if (!password.currentPassword) {
                this.currentPassword = true
            } else if (!password.newPassword) {
                this.newPassword = true
            } else {
                this.confirmPassword = true
            }
        },

        onSavePassword(){
            let newPasswordReset = {
                currentPassword: this.currentPassword,
                newPassword: this.newPassword,
                confirmPassword: this.confirmPassword,
            }
            axios.post('/reset-password/' + this.id, newPasswordReset).then((res=> {
                console.log(res.data);
            }))
        }
    },
})
</script>