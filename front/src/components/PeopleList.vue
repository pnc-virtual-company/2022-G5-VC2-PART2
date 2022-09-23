<template>
  <table class="table-auto justify-between w-full rounded shadow p-4">
    <thead>
      <tr class="p-4 bg-blue-300 shadow text-sm">
        <th class="text-center px-4 p-2 w-32">Profile</th>
        <th class="text-center p-2 w-40">First Name</th>
        <th class="text-center p-2 w-40">Last Name</th>
        <th class="text-center p-2 w-64">Email</th>
      </tr>
    </thead>
    <tbody class="bg-slate-100">

        <tr  class=" relative p-2 h-16 hover:bg-slate-200 group cursor-pointer" v-for="person of peopleList"
          :key="person.id" @click="showStudentDetail(person)">
          <td >  
            <div class="flex items-cener justify-center">
              <img  :src="getProfile(person.profile)" class="w-12 h-12 rounded-full border-2 border-primary" />
            </div>
          </td>
          <td >{{ person.first_name }}</td>
          <td >{{ person.last_name }}</td>
          <td>
            {{ person.email }}
            <div class="absolute top-2.5  justify-end right-2 z-50 hidden group-hover:flex " v-if="this.$store.state.role !='STUDENT'">
              <div class="relative"  v-if="this.$store.state.role !='TEACHER'">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                  class="add-people w-9 h-9  bg-white rounded-full cursor-pointer p-2 stroke-rose-600 shadow"
                  @click="$emit('alertDelete', person.student_id,$event)"
                >
                  <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                />
                </svg>
                <div id="view-delete" class="add-button absolute -top-10 z-50 text-center opacity-0 -right-11 text-sm w-32 bg-[#ff000f] rounded-full text-white p-1.5 ">
                  Remove from list
                </div>
              </div>
            </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "../axios-http";
export default {
  props: {
    peopleList: Array,
  },
  methods: {
    getProfile(image) {
      console.log(this.peopleList);
      return axios.defaults.baseURL + "storage/image/" + image;
    },
    showStudentDetail(person){
      this.$router.push({name:'peopleDetail', params:{id:person.student_id,role:person.roles}})
    }
  },
};
</script>

<style>
tr:nth-child(even) {
  background-color: #ddeeee;
}

#view-delete:before {
  background: #ff000f;
  left: 64px;
}
#view-detail:before {
  background: #1596e0;
  left: 68px;
}
</style>
