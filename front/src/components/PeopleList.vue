<template>
  <table class="table-auto justify-between w-full rounded shadow p-4">
    <thead>
      <tr class="p-4 bg-blue-400 shadow">
        <th class="text-center px-4 p-2 w-32">Profile</th>
        <th class="text-center p-2 w-40">First Name</th>
        <th class="text-center p-2 w-40">Last Name</th>
        <th class="text-center p-2 w-64">Email</th>
      </tr>
    </thead>
    <tbody class="bg-slate-100">
        <tr @click="$emit('showDetail',person.id)" class="text-center relative p-2 h-16 hover:bg-slate-200 cursor-pointer group" v-for="person of peopleList"
          :key="person.id">
          <td class="text-center">
            <div class="flex items-cener justify-center">
              <img  :src="person.profile" class="w-10 h-10 rounded-full" />
            </div>
          </td>
          <td class="text-center">{{ person.first_name }}</td>
          <td class="text-center">{{ person.last_name }}</td>
          <td class="text-left flex justify-between mt-5">
            {{ person.email }}
            <div class="flex absolute  justify-end right-2 z-50" @click="deletePerson(person.id)">
              <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mr-4 hidden group-hover:block text-red-500 cursor-pointer ease-in-out duration-200 z-50" >
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
              </svg>
            </div>
          </td>
        </tr>
    </tbody>
  </table>
    <delete-alert v-if="isDeleteAlert" @cancelDelete="isDeleteAlert=false" />
</template>

<script>
import deleteAlert from "./delete/DeleteAlert.vue"
export default {
  components:{
    "delete-alert": deleteAlert
  },
  props: {
    peopleList: Array,
    dataToShow: Number,
  },
  data(){
    return{
      isHover: false,
      isDeleteAlert:false,
    }
  },
  methods: {
    deletePerson(id){
      this.isDeleteAlert = true;
      console.log(id);
    },

  }
};
</script>

<style></style>
