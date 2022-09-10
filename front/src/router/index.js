import { createRouter, createWebHistory } from 'vue-router'

import DashboardView from '../views/Admin/dashboard/DashboardView.vue'
import FollowUpView from '../views/Admin/followUp/FollowUpView.vue'
import PeopleView from '../views/Admin/people/PeopleView.vue'
import LoginView from '../views/Admin/login&signout/LoginView.vue'
import ProfileView from '../views/Admin/ProfileAdmin/ProfileView.vue'
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
    path: '/people',
    name: 'people',
    component: PeopleView,

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

]

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router