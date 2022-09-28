<template>
    <div>
        <div class="w-[90%] m-auto mt-20 mb-5  p-4 rounded">
            <h1 class="text-2xl text-center text-blue-600 uppercase"><b>Student in follow up list all generation</b></h1>
            <div class="relative flex justify-end">
                <svg class="add-people w-14 h-10 rounded shadow hover:bg-slate-200 bg-white text-indigo-500 cursor-pointer p-2"
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
            <div class="ml-[38vw] mt-3" v-if="loading">
                <span>
                    <svg class="ml-4 w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    Loading.....
                </span>
            </div>
            <div class=" w-[100%] flex flex-col items-center" v-else-if ="allFollowUp.length === 0">
                <img src="../../assets/noRequestFound.png" class="w-40" alt="">
                <h1 class="text-gray-400">No Student Follow Up!</h1>
            </div>
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
            loading:true,
        }
    },
    methods: {
        showStudentListPopUp() {
            this.isShowPopUp = true
        },

        getAllFollowUp() {
            axios.get('/follow_ups/').then((res => {
                this.allFollowUp = res.data;
            }));
        },

        confirmAdd() {
            this.getAllFollowUp();
            this.isShowPopUp = false;
        },

        getProfile(image) {
            return axios.defaults.baseURL + "storage/image/" + image;
        },
        onDelete(id,event){
            event.stopPropagation();
            axios.delete('/follow_ups/' + id).then((()=>{
                this.getAllFollowUp();
            }));
        },
        viewStudentDetail(followUp){
            this.$router.push({name:'studentDetailFollowUp', params:{id:followUp.student_id,role:followUp.roles}});
        }
    },
    mounted() {
        setTimeout(() =>{
            this.loading = false
        },1500)
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