<template>
<div class="relative mt-20"  >
    <div  v-for="batch of batches" :key="batch.id">
        <div class="w-[88%] m-auto mt-2 mb-5  p-4 rounded bg-white ">
            <div class="p-2 bg-gray-300 shadow flex justify-between items-center mt-2">
                <p></p>
                <h2 class="text-center text-2xl font-bold text-primary ">{{batch.year}}</h2>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="add-people w-6 h-6  cursor-pointer" @click="showActions($event)" :id = batch.id>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                    </svg>
                </div>
                <edit-remove v-if="isRemoveBatch" :id= batch.id ></edit-remove>
            </div>
        </div>
    <card-class />
    </div>  
    <class-batch v-if="isShowForm" @createNewBatch="createBatch,isShowForm=false" @closeForm="isShowForm=false"/>
</div>
</template>

<script>
import axiosHttp from '../../../axios-http'
import Edit_Remove from '../action/ActionCard.vue';
import cardClass from '../Card/CardClass.vue';
export default {
    components:{
        "edit-remove": Edit_Remove,
        "card-class": cardClass,
    },
    data(){
        return {
            isShowForm: false,
            isRemoveBatch: false,
            batches: [],
        }
    },
    methods:{
        showForm(){
            this.isShowForm = true;
        },
        createBatch(newBatch) {
            axiosHttp.post('/batches', newBatch);
        },
        showActions(event){     
            console.log(event.target.id);
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
