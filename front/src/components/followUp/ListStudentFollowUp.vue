<template>
    <div>
        <div class="w-[90%] m-auto mt-20 mb-5  p-4 rounded">
            <h1 class="text-2xl text-center text-primary uppercase">Student in follow up list all generation</h1>
            <div class="relative flex justify-end">
                <svg class="add-people w-14 h-10 rounded shadow hover:bg-slate-200 bg-white text-primary cursor-pointer p-2"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" @click="showStudentListPopUp">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div id="show-student-list"
                    class="add-button absolute z-50 -top-12 opacity-0 -right-10 text-sm w-32 bg-[#0081CA] rounded-full text-white p-1.5 text-center">
                    Show list student
                </div>
            </div>
            <!--list student follow up  -->
            <table class="table-auto justify-between w-full rounded shadow p-4 mt-2">
                <thead>
                    <tr class="p-4 bg-blue-300 shadow text-sm">
                        <th class="text-center px-4 p-2 w-32">Profile</th>
                        <th class="text-center p-2 w-40">UserName</th>
                        <th class="text-center p-2 w-40">Class</th>
                        <th class="text-center p-2 w-64">Batch</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-100">

                    <tr v-for="followup in allFollowUp" :key="followup" @click="viewStudentDetail(followup)"
                        class="text-center relative p-2 h-16 hover:bg-slate-200 group cursor-pointer">
                        <td >
                            <div class="flex items-cener justify-center">
                                <img :src="getProfile(followup.profile)"
                                    class="w-12 h-12 rounded-full border-2 border-primary" />
                            </div>
                        </td>
                        <td >{{followup.first_name}} {{followup.last_name}}</td>
                        <td >{{followup.class_name}}</td>
                        <td >{{followup.year}}
                            <div class="absolute top-2.5  justify-end right-2 z-50 hidden group-hover:flex " v-if="this.$store.state.role=='Coordinator'">
                                <div class="relative">
                                    <svg class="add-people w-9 bg-white h-9 rounded-full  cursor-pointer p-2 stroke-red-500 shadow mr-2"
                                        @click="onDelete(followup.student_id,$event)"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                                    </svg>
                                    <div id="remove-student"
                                        class="add-button absolute -top-11 z-50 text-center opacity-0 -right-10 text-sm w-32 bg-[#CA0000] rounded-full text-white p-1.5">
                                        remove student
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <follow-form v-if="isShowPopUp" @closeForm="isShowPopUp=false" @add-student="confirmAdd" />
    </div>
</template>
<script>
import followUpForm from '../../components/followUp/FollowUpForm.vue';
import axios from "../../axios-http";
export default {
    components: {
        'follow-form': followUpForm
    },
    data() {
        return {
            isShowPopUp: false,
            allFollowUp: [],
        }
    },
    methods: {
        showStudentListPopUp() {
            this.isShowPopUp = true
        },

        getAllFollowUp() {
            axios.get('/users/follow_ups/').then((res => {
                this.allFollowUp = res.data;
            }))
        },

        confirmAdd() {
            this.getAllFollowUp();
            this.isShowPopUp = false;
        },

        getProfile(image) {
            return axios.defaults.baseURL + "storage/image/" + image;
        },

        // method to delete student from follow up 

        onDelete(id,event){
            event.stopPropagation();
            axios.delete('/users/follow_ups/' + id).then((res=>{
                this.getAllFollowUp();
                console.log(res)
            }));
        },
        viewStudentDetail(followUp){
            this.$router.push({name:'studentDetailFollowUp', params:{id:followUp.student_id,role:followUp.roles}});
        }
    },
    mounted() {
        this.getAllFollowUp();
    }
}
</script>
<style>
#remove-student:before {
    background: #CA0000;
}

#show-student-list:before {
    background: #0081CA;
}

#view-detail:before {
    background: #1596e0;
}
</style>