import { createRouter, createWebHistory } from 'vue-router';
import LoginView from "../views/Admin/login&signout/LoginView";
import ForgotPasswordView from "../views/Admin/login&signout/ForgotPasswordView";
import DashboardView from '../views/Admin/dashboard/DashboardView.vue';
import FollowUpView from '../views/Admin/followUp/FollowUpView.vue';
import ProfileView from '../views/Admin/ProfileAdmin/ProfileView.vue';
import PeopleDetailView from '../views/Admin/people/PeopleDetailView';  
import TeacherView from "../views/Admin/people/teacher/TeacherView.vue";
import StudentView from "../views/Admin/people/student/StudentView.vue";
import BatchView from "../views/Admin/people/student/BatchView";
import StudentDetailFollowUp from "../views/Admin/followUp/FollowUpDetailView.vue";
import YourFollowUp from "../views/Admin/followUp/YourFollowUp.vue";
import { store } from '@/store/store';
import NotFound from '../views/Admin/NotFound.vue';
import Notification from '../views/Admin/notification/NotificationView.vue'
const routes = [
  {
    path: '/',
    name: 'dashboard',
    component: DashboardView,
    meta: {
      auth: true
    }
  },
  {
    path: '/followUp',
    name: 'followUp',
    component: FollowUpView,
    meta: {
      auth: true
    }

  },
  {
    path: '/teacher',
    name: 'teacher',
    component: TeacherView,
    meta: {
      auth: true
    }
  },
  {
    path: '/student',
    name: 'student',
    component: StudentView,
    meta: {
      auth: true
    }
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
    meta: {
      auth: false
    }
  },
  {
    path: '/forgot',
    name: 'forgot',
    component: ForgotPasswordView,
    meta: {
      auth: false
    }
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfileView,
    meta: {
      auth: true
    }
  },
  {
    path: '/batch',
    name: 'batch',
    component: BatchView,
    meta: {
      auth: true
    }
  },
  {
    path: '/peopleDetail/:role/:id',
    name: 'peopleDetail',
    component: PeopleDetailView,
    props: true,
    meta: {
      auth: true
    }
  },
  {
    path: '/studentDetailFollowUp/:role/:id',
    name: 'studentDetailFollowUp',
    component: StudentDetailFollowUp,
    props: true,
    meta: {
      auth: true
    }
  },
  {
    path: '/notification',
    name: 'notification',
    component: Notification,
    props: true,
    meta: {
      auth: true
    }
    
  },
  {
    path: '/yourFollowup',
    name: 'yourFollowup',
    component: YourFollowUp,
    props: true,
    meta: {
      auth: true
    }
  }, 
  {
    path: '/:pathMatch(.*)*',
    component: NotFound,
  }


]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: routes,
  mode: "hash",
  linkExactActiveClass: 'active'
});

router.beforeEach((to, from ,next) => {
  if (to.meta.auth && !store.state.authenticated) {
    next('/login')
  } else if (
    !to.meta.auth && store.state.authenticated
  ){
    if (store.state.role == "Coordinator"){
      next('/');
    } else if (store.state.role == "TEACHER"){
      next('/');
    }else{
      next('/');
    }
  }else{
    next()
  }
})

export default router