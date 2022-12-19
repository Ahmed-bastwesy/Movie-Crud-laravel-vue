import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import movieListComponent from '../components/movieComponents/movieListComponent.vue'
import createEditFormComponent from '../components/movieComponents/createEditFormComponent.vue'
import loginComponent from "../components/authComponents/loginComponent.vue";
import logoutComponent from "../components/authComponents/logoutComponent.vue";
import registerComponent from "../components/authComponents/registerComponent.vue";
import NotFoundComponent from "../components/NotFoundComponent.vue";
const routes = [
  {
    path: '/',
    name: 'home',
    component: movieListComponent
  },
  {
    path: '/login',
    name: 'login',
    component: loginComponent
  },
  {
    path: '/logout',
    name: 'logout',
    component: logoutComponent
  },
  {
    path: '/register',
    name: 'register',
    component: registerComponent
  },
  {
    path: '/movie/create',
    name: 'createMovie',
    component: createEditFormComponent
  },
  {
    path: '/movie/:id/edit',
    name: 'editMovie',
    component: createEditFormComponent
  },
  {
    path: '/:catchAll(.*)',
    name: 'notFoundPage',
    component: NotFoundComponent
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('user');
  if (authRequired && !loggedIn) {
    next('/login');
  } else {
    next();
  }
});

export default router
