<template>
  <div class="min-w-full h-full bg-black left-0 z-50 bg-opacity-60 flex items-center justify-center fixed top-0">
    <div class="main-form w-[30%]">
      <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
        <p class="ml-3">UPDATE CLASS</p>
        <slot name="card-title"></slot> 
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" @click="$emit('closeForm',false)">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
      </div>
      <form class="shadow p-4 bg-white py-9 rounded-b" @submit.prevent="updateClass">
        <div class="flex w-full">
          <br />
          <input
            type="text"
            class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            placeholder="Class ..."
            v-model="newName"
            :class="{'border-red-500' :error}"
          />
          <button-create>
            <template v-slot:button_create>Changed</template>
          </button-create>
        </div>
      </form>
    </div>
  </div>
<p></p>
</template>

<script>
import axiosHttp from '../../../axios-http';
export default {
  data() {
    return {
      newName: '',
      batchId: null,
      error: false
    }
  },
  props: ['classId'],
  methods: {
    updateClass() {
      if (this.newName === '') {
        this.error = true;
      }
      else{
        this.error = false;
        let newClassUpdated = {
          class_name: this.newName,
          batch_id: this.batchId
        };
        axiosHttp.post('/class/' + this.classId,newClassUpdated);
        this.$emit('closeForm');
      }
    },
    getOneClass() {
      axiosHttp.get('/class/' + this.classId).then(res => {
        this.newName = res.data.class_name;
        this.batchId = res.data.batch_id;
      })
    },
  },
  mounted() {
    this.getOneClass();
  }
}
</script>
