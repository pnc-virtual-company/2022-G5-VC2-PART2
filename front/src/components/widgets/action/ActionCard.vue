<template>
        <div id="cardAction" class="bg-white rounded p-2 w-[10%] right-[46px] top-[70px]  absolute text-center  h-auto">
            <div class="flex items-center  p-2 rounded hover:bg-teal-300 ease-in-out duration-200 cursor-pointer text-sm" @click="editBatch">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                <p>Edit</p>
            </div>
            <div class="flex items-center  p-2 rounded mt-2 hover:bg-red-300 ease-in-out duration-200 cursor-pointer  text-sm" @click="alertDelete">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-red-500  ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                <p>Remove</p>
            </div>
        </div>
        <delete-alert v-if="isDeleteAlert" @delete-user="deletedPerson"/>
        <edit-batch v-if="isEditBatch"/>
</template>

<script>
import deleteAlert from './DeleteAlert.vue'
import edit_batch from '../Edit/EditBatch.vue';
export default {
    components:{
        'delete-alert':deleteAlert,
        'edit-batch':edit_batch,
    },
    data(){
        return{
            isDeleteAlert:false,
            isEditBatch: false,
        }
    },
    methods:{
        alertDelete(){
            this.isDeleteAlert = true;
        },
        editBatch(){
            this.isEditBatch= true;
        }
    }
}
</script>

<style>
#cardAction::before{
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  background: #fff;
  left: 60px;
  top: -7px;
  transform: translateX(-50%) rotate(45deg);
}
</style>