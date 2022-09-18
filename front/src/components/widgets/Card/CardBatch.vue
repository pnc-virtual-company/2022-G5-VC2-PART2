<template>
<div class="relative mt-20"  >
    <div class="relative flex justify-end">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="add-people w-10 h-10 rounded shadow hover:bg-slate-200 bg-white cursor-pointer p-2 mr-20" @click="showForm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        <div id="cardBatch" class="add-button absolute z-50 -top-12 opacity-0 right-8 text-sm w-32 bg-[#1a1a1a] rounded-full text-white p-1.5 text-center">
            Add new batch
        </div>
    </div>
    <div  v-for="batch of batches" :key="batch.id">
        <div class="w-[88%] m-auto mt-2 mb-5  p-4 rounded bg-white ">
            <div class="p-2 bg-gray-100 shadow flex justify-between items-center mt-2">
                <p></p>
                <h2 class="text-center text-2xl font-bold text-primary ">Student Batch {{batch.year}}</h2>
                <div class="relative flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-primary cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-red-500  cursor-pointer" @click="alertDelete(batch.id)">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </div>
            </div>
            <card-class />
        </div>
    </div>  
</div>
    <class-batch v-if="isShowForm" @createNewBatch="createBatch" @closeForm="isShowForm=false"/>
    <delete-alert v-if="isDeleteAlert" :id="id" @delete-batch="confirmDelete" @cancelDelete="isDeleteAlert=false"/>
</template>

<script>
import axiosHttp from '../../../axios-http'
import deleteAlert from '../action/DeleteAlert.vue'
import CardClass from "../Card/CardClass.vue"
export default {
    components:{
        "card-class": CardClass,
        'delete-alert':deleteAlert,
    },
    data(){
        return {
            id: '',
            isShowForm: false,
            isDeleteAlert:false,
            batches: [],
        }
    },
    provide:{
        content: "batch"
    },
    methods:{
        showForm(){
            this.isShowForm = true;
        },
        alertDelete(id){
            this.isDeleteAlert = true;
            this.id = id;
        },
        confirmDelete(){
            this.isShowForm = false;
                this.getAllBatches();
        },
        createBatch(newBatch){
            axiosHttp.post('/batches',newBatch).then((res)=>{   
                console.log(res.data); 
                this.isShowForm=false; 
                this.getAllBatches();
            });
        },
        showActions(){     
            this.isRemoveBatch=true;
        },
        getAllBatches() {
            axiosHttp.get('/batches').then(res => {
                this.batches = res.data;
            })
        }
    },
    mounted() {
        this.getAllBatches();
    }
}
</script>
