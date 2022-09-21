<template>
    <div  class="fixed top-0 w-full h-[100vh] bg-black flex items-center justify-center bg-opacity-50 z-50">
        <div class="bg-gray-200 rounded p-4 w-[30%]" >
            <div class="flex items-center border-[3px] border-red-500 justify-center w-24  h-24  rounded-full text-red-500 m-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </div>
            <div class="text-center">
                <h1 class="text-3xl mt-4 mb-2">Are you sure?</h1>
                <p class="text-lg">You want to delete</p>
            </div>
            <div class="flex justify-center mt-6">
                <button class="p-2 px-4 text-green-500  font-bold rounded cursor-pointer mr-1 hover:bg-green-200 " @click="$emit('cancelDelete')">Cancel</button>
                <button class="p-2 px-6 text-red-500 font-bold rounded cursor-pointer ml-1 hover:bg-red-200" @click="handleDelete">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
import axiosHttp from "../../../axios-http"
export default({
    props:{
        id: Number,
    },
    inject: ['content'],
    emits: ['delete-user','delete-batch'],
    methods:{
        handleDelete(){
            if (this.content == "batch"){
                this.$emit('delete-batch');

            }else{
                console.log(this.id)
                axiosHttp.delete('/users/delete/'+ this.id).then(this.$emit('delete-user'));
            }
        }
    }
})
</script>
