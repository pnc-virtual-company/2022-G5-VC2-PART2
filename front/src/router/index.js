import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '../views/Admin/dashboard/DashboardView.vue'
import FollowUpView from '../views/Admin/followUp/FollowUpView.vue'
import LoginView from '../views/Admin/login&signout/LoginView.vue'
import ProfileView from '../views/Admin/ProfileAdmin/ProfileView.vue'
import PeopleDetailView from '../views/Admin/people/PeopleDetailView'  
import TeacherView from "../views/Admin/people/teacher/TeacherView.vue";
import StudentView from "../views/Admin/people/student/StudentView.vue";
// import {storeToken} from '../storetoken/storeToken';
const routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardView,
    meta: {
      needLogin: true
    }
  },
  {
    path: '/followUp',
    name: 'foolowUp',
    component: FollowUpView,
    meta: {
      needLogin: true
    }

  },
  {
    path: '/teacher',
    name: 'teacher',
    component: TeacherView,
    meta: {
      needLogin: true
    }
  },
  {
    path: '/student',
    name: 'student',
    component: StudentView,
    meta: {
      needLogin: true
    }
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,

  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView,
    meta: {
      needLogin: true
    }

  },
  {
    path: '/peopleDetail/:role/:id',
    name: 'peopleDetail',
    component: PeopleDetailView,
    props: true,
    meta: {
      needLogin: true
    }
  },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router