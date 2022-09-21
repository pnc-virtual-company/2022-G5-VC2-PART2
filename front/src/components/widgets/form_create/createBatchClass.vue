<template>
    <div class="w-full h-full bg-black ease-in-out duration-500 z-50 bg-opacity-30 flex justify-center fixed top-0">
        <div class="w-[30%] bg-white h-auto rounded shadow  m-auto mt-12">
            <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
                <p class="ml-28">Create New Batch</p>
                <!-- use v-slot to put your title of card -->
                <slot name="card-title"></slot> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" @click="$emit('closeForm')">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <form class="shadow p-4 bg-white py-9 rounded-b" @submit.prevent="addBatch">
                <div class="flex">
                    <br />
                    <div class="w-full mb-1">
                        <input
                            type="number"
                            class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
                            id="lastNameInput"
                            placeholder= "Batch..."
                            v-model="year"
                        />
                    </div>
                    <div class="ml-2">
                        <button-create>
                            <template v-slot:button_create >Add</template>      
                        </button-create>
                    </div>
                </div>
                <p v-if="isEmpty">Please put batch!*</p>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return{
            year: null,
            isEmpty: false,
        }
    },
    methods:{
        addBatch(){
            if (this.year !== null){
                let newBatch = {
                    year: this.year
                };
                this.$emit('createNewBatch', newBatch);
            }else{
                this.isEmpty = true;
            }
        }
    }
}
</script>
