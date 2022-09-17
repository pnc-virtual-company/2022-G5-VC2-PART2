<template>
<div class="relative">
    <div class="w-[88%] m-auto mt-20 mb-5  p-4 rounded bg-gray-100 ">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="add-people w-10 h-10 rounded shadow hover:bg-slate-200 bg-gray-100 cursor-pointer p-2 ml-auto" @click="showForm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div id="cardBatch" class="add-button absolute -top-10 z-50 text-center opacity-0 -right-11 text-sm w-32 bg-[#1596e0] rounded-full text-white p-1.5">
                 Add new Batch
            </div>
        </div>
        <div class="p-2 bg-gray-300 shadow flex justify-between items-center mt-2">
            <p></p>
            <h2 class="text-center text-2xl font-bold text-primary ">Batch 2022</h2>
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="add-people w-10 h-10 rounded shadow hover:bg-slate-200 bg-gray-100 cursor-pointer p-2" @click="removeBatch">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                </svg>
                <div id="cardBatch" class="add-button absolute -top-10 z-50 text-center opacity-0 -right-11 text-sm w-32 bg-[#1596e0] rounded-full text-white p-1.5">
                    Edit or Remove
                </div>
            </div>
        </div>
    </div>
    <batch-card v-if="isShowForm" @createNewBatch="createBatch,isShowForm=false" @closeForm="isShowForm=false"/>
    <edit-remove v-if="isRemoveBatch"/>
</div>
</template>

<script>
import axiosHttp from '../../../axios-http'
import batchCard from '../form_create/CreateBatchClass.vue';
import Edit_Remove from '../action/ActionCard.vue';
export default {
    components:{
        "batch-card": batchCard,
        "edit-remove": Edit_Remove,
    },
    data(){
        return {
            isShowForm: false,
            isRemoveBatch: false,
        }
    },
    methods:{
        showForm(){
            this.isShowForm = true;
        },
        createBatch(newBatch) {
            axiosHttp.post('/batches', newBatch);
        },
        removeBatch(){
            this.isRemoveBatch= !this.isRemoveBatch;
        },
    }
}
</script>

<style>
    #cardBatch::before{
        background: #1596e0;
    }
</style>