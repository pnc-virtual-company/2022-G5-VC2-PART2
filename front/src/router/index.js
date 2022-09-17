import { createRouter, createWebHistory } from 'vue-router'

import LoginView from "../views/Admin/login&signout/ConfirmEmailLoginView"
import CreatePasswordView from "../views/Admin/login&signout/CreatePasswordView";
import SetPasswordView from "../views/Admin/login&signout/SetPasswordView";
import DashboardView from '../views/Admin/dashboard/DashboardView.vue';
import FollowUpView from '../views/Admin/followUp/FollowUpView.vue';
import ProfileView from '../views/Admin/ProfileAdmin/ProfileView.vue';
import PeopleDetailView from '../views/Admin/people/PeopleDetailView';  
import TeacherView from "../views/Admin/people/teacher/TeacherView.vue";
import StudentView from "../views/Admin/people/student/StudentView.vue";
// import { store } from '../store/store'
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
    path: '/createPassword',
    name: 'createPassword',
    component: CreatePasswordView,
    // meta: {
    //   auth: false
    // }
  },
  {
    path: '/setPassword',
    name: 'setPassword',
    component: SetPasswordView,
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

// router.beforeEach(async (to) => {
//   const publicPages = ['/login'];
//   console.log(store.state.userEmail);
//   const authRequired = !publicPages.includes(to.path);
//   if (authRequired && !store.state.userEmail) {
//     return '/login';
//   }
// });
export default router