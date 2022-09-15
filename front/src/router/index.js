import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '../views/Admin/dashboard/DashboardView.vue';
import FollowUpView from '../views/Admin/followUp/FollowUpView.vue';
import LoginView from "../views/Admin/login&signout/LoginView.vue";
import ProfileView from '../views/Admin/ProfileAdmin/ProfileView.vue';
import PeopleDetailView from '../views/Admin/people/PeopleDetailView';  
import TeacherView from "../views/Admin/people/teacher/TeacherView.vue";
import StudentView from "../views/Admin/people/student/StudentView.vue";
const routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardView,
    // meta: {
    //   auth: true
    // }
  },
  {
    path: '/followUp',
    name: 'foolowUp',
    component: FollowUpView,
    // meta: {
    //   auth: true
    // }

  },
  {
    path: '/teacher',
    name: 'teacher',
    component: TeacherView,
    // meta: {
    //   auth: true
    // }
  },
  {
    path: '/student',
    name: 'student',
    component: StudentView,
    // meta: {
    //   auth: true
    // }
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
    // meta: {
    //   auth: false
    // }
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView,
    // meta: {
    //   auth: true
    // }

  },
  {
    path: '/peopleDetail/:role/:id',
    name: 'peopleDetail',
    component: PeopleDetailView,
    props: true,
    // meta: {
    //   auth: true
    // }
  },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// router.beforeEach((to)=>{
//   console.log(to);
//   return "/login"
// })

export default router