<template>
<div>
    <div class="relative mt-20"  >
        <div class="relative flex justify-end">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="add-people w-10 h-10 rounded shadow hover:bg-slate-200 bg-white text-primary cursor-pointer p-2 mr-20" @click="isShowForm=true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            <div id="cardBatch" class="add-button absolute z-50 -top-12 opacity-0 right-8 text-sm w-32 bg-[#1a1a1a] rounded-full text-white p-1.5 text-center">
                Add new batch
            </div>
        </div>
        <div class="ml-[45vw] mt-[25vh]" v-if="loading">
          <span class="" id="wait">
            <svg class="ml-4 w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
              <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            Loading.....
          </span>
        </div>
        <div v-else-if="batches.length === 0" class="flex flex-col items-center mt-8 mb-3">
          <img class="w-40" src="../../../assets/noRequestFound.png" alt="Image not found">
          <h1 class="text-stone-500 mt-5 ">No Batch here!</h1>
        </div>
        <div v-else v-for="batch of batches" :key="batch.id">
            <div class="w-[88%] m-auto mt-2 mb-5  p-4 rounded bg-white ">
                <div class="p-2 bg-gray-100 shadow flex justify-between items-center mt-2" v-if="!isEditBatch">
                    <p></p>
                    <h2 class="text-center text-2xl font-bold text-primary ">Student Batch {{batch.year}}</h2>
                    <div class="relative flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-primary cursor-pointer" @click="showEdit(batch.id)">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-red-500  cursor-pointer" @click="alertDelete(batch.id)">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-wrap items-center">
                    <card-class v-for="cardClass of batch.classes" :key="cardClass.id" :cardName="cardClass.class_name" :classId="cardClass.id" @reloadData="getAllBatches" :numberStudent="cardClass.students.length"/> 
                    <div class="bg-gray-100 shadow rounded-[60rem] group w-15 flex justify-center items-center text-primary m-[60px] ml-8 cursor-pointer hover:bg-white" @click="showFormCreateClass(batch.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>  
    </div>
        <class-batch v-if="isShowForm" @createNewBatch="createBatch" @closeForm="isShowForm=false,messageError=''" :message="messageError"/>
        <class-create v-if="isCreateClass" @closeForm="isCreateClass=false,errorClass=''" @addNewClass = "createNewClass" :messageErrorClass ="errorClass"/>
        <delete-alert v-if="isDeleteAlert" :id="id" @delete-batch="confirmDelete" @cancelDelete="isDeleteAlert=false"/>
        <div v-if="isEditBatch" class="fixed top-0 z-50 rounded-t w-full h-screen bg-dark bg-opacity-25 ">
            <form class="w-[34%] bg-white h-[26vh] rounded shadow  m-auto mt-12" @submit.prevent="updateBatches">
                <div class="flex text-center text-xl bg-primary p-2 text-white justify-between">
                    <h1 class="text-center text-xl ml-28">Update Batch</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" @click="isEditBatch=false">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="p-3 flex w-full justify-center mt-5">
                    <div  class="w-[72%]" >
                        <input type="number" v-model="year" class=" appearance-none border  rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline" >
                        <p>{{errorUpdate}}</p>
                    </div>
                    <div class="relative flex items-center justify-end ml-2 mb-1" >
                        <button-create>
                            <template v-slot:button_create >Change</template>      
                        </button-create>
                    </div>
                </div>
            </form>
        </div>
</div>

</template>

<script>
import axiosHttp from '../../../axios-http'
import deleteAlert from '../action/DeleteAlert.vue'
import CardClass from "../Card/CardClass.vue"
import ClassCreate from '../form_create/CreateClass.vue';
export default {
    components:{
        "card-class": CardClass,
        'delete-alert':deleteAlert,
        'class-create': ClassCreate,
    },
    data(){
        return {
            id: null,
            isShowForm: false,
            isDeleteAlert:false,
            isEditBatch: false,
            isConcel: false,
            batches: [],
            isCreateClass: false,
            storeBatchId: null,
            storeClassEdit: null,
            year: null,
            loading: true,
            messageError: '',
            errorUpdate: '',
            errorClass: '',
        }
    },
    provide:{
        content: "batch",
    },
    methods:{
        alertDelete(id){
            this.isDeleteAlert = true;
            this.id = id;
        },
        confirmDelete(){
            axiosHttp.delete('batches/delete/'+ this.id).then((res)=>{
                this.isShowForm = false;
                this.isDeleteAlert = false;
                this.getAllBatches();
                console.log(res.data);
            });
        },
        createBatch(newBatch){
            axiosHttp.post('/batches',newBatch).then(() =>{
                this.isShowForm=false; 
                this.getAllBatches();
                this.messageError = '';
            }).catch((error) =>{
                if (error.response.status === 422) {
                    this.messageError = error.response.data.message;
                }
            });
        },
        showActions(){     
            this.isRemoveBatch=true;
        },
        showFormCreateClass(batch_id) {
            this.isCreateClass = true;
            this.storeBatchId = batch_id;
        },

        getAllBatches() {
            axiosHttp.get('/batches').then(res => {
                setTimeout(() => {
                    this.loading = false;
                },50);
                this.batches = res.data;
            })
        },
        createNewClass(newClass) {
            let makeNewClass = {
                batch_id: this.storeBatchId,
                class_name: newClass
            }
            axiosHttp.post('/classes',makeNewClass).then(() => {
                this.isCreateClass = false;
                this.getAllBatches();
                this.errorClass = '';
            }).catch((error) =>{
                if (error.response.status === 422) {
                    this.errorClass = error.response.data.message;
                }
            });
        },
        showEdit(id){
            this.isEditBatch = true;
            this.id = id;
            axiosHttp.get('/batches/' + this.id).then(res =>{
                this.year = res.data.year;
            });
        },
        updateBatches() {
            axiosHttp.put('/batches/' + this.id,{year:this.year}).then(() =>{
                this.isEditBatch = false;
                this.getAllBatches();
            }).catch((error) =>{
                if (error.response.status === 422) {
                    this.errorUpdate = error.response.data.message;
                }
            });
            
        },
    },
    mounted() {
        this.getAllBatches();
    }
}
</script>
<style scoped>
p{
    color: red;
    font-size: 13px;
}
</style>
