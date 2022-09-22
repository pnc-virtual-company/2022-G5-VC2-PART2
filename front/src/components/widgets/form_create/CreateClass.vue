<template>
  <div class="w-full h-full bg-black z-50 bg-opacity-30 flex justify-center fixed top-0">
    <div class="w-[30%] mt-12">
      <div class="p-2 bg-blue-500 text-center flex justify-between text-white text-lg uppercase rounded-t">
        <p></p>
        <p class="ml-3">CREATE NEW CLASS</p>
        <slot name="card-title"></slot> 
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer" @click="$emit('closeForm')">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
      </div>
      <form class="shadow p-4 bg-white py-9 rounded-b" @submit.prevent="addNewClass">
        <div class="flex w-full">
          <br />
          <input
            type="text"
            class="shadow appearance-none border rounded w-full px-2 p-2 text-gray-700 mb-1 leading-tight focus:outline-blue-500 focus:shadow-outline"
            id="lastNameInput"
            placeholder="Class ..."
            v-model="newClass"
            :class="{'border-red-600' :error}"
          />
          <button-create>
            <template v-slot:button_create>Create</template>
          </button-create>
        </div>
      </form>
    </div>
  </div>
<p></p>
</template>
<script>
export default {
    data() {
        return {
            newClass: '',
            error: false
        }
    },
    methods: {
        addNewClass() {
            if(this.newClass === '') {
                this.error = true;
            }else{
                this.$emit('addNewClass',this.newClass);
            }
        }
    }
}
</script>