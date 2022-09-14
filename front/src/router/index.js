import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '../views/Admin/dashboard/DashboardView.vue'
import FollowUpView from '../views/Admin/followUp/FollowUpView.vue'
import LoginView from '../views/Admin/login&signout/LoginView.vue'
import ProfileView from '../views/Admin/ProfileAdmin/ProfileView.vue'
import PeopleDetailView from '../views/Admin/people/PeopleDetailView'  
import TeacherView from "../views/Admin/people/teacher/TeacherView.vue";
import StudentView from "../views/Admin/people/student/StudentView.vue";
const routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardView,

  },
  {
    path: '/followUp',
    name: 'foolowUp',
    component: FollowUpView,

  },
  {
    path: '/teacher',
    name: 'teacher',
    component: TeacherView,
  },
  {
    path: '/student',
    name: 'student',
    component: StudentView,
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

  },
  {
    path: '/peopleDetail/:role/:id',
    name: 'peopleDetail',
    component: PeopleDetailView,
    props: true,
  },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router