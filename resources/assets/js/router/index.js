import Vue from 'vue'
import Router from 'vue-router'

import DefaultContainer from '../container/DefaultContainer.vue'
import Dashboard from '../components/Dashboard.vue'
import Person from '../components/person/Index.vue'
import Position from '../components/position/Index.vue'
import PersonType from '../components/person_type/Index.vue'
import Login from '../components/pages/Login.vue'
import Register from '../components/pages/Register.vue'
import Page404 from '../components/pages/404.vue'
import Page500 from '../components/pages/500.vue'

window.Vue = Vue

Vue.use(Router)

let router = new Router({
  mode: 'history',
  history: true,
  linkActiveClass: 'open active',
  scrollBehavior: () => ({
    y: 0
  }),
  routes: [{
      path: '/',
      name: 'login',
      component: Login,
      meta: {
        middlewareAuth: false
      }
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        middlewareAuth: false
      }
    },
    {
      path: '/404',
      name: 'Page404',
      component: Page404
    }, {
      path: '/500',
      name: 'Page500',
      component: Page500
    },
    {
      path: '/',
      name: 'Home',
      redirect: '/dashboard',
      component: DefaultContainer,
      meta: {
        middlewareAuth: true
      },
      children: [{
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard,
          meta: {
            middlewareAuth: true
          }
        },
        {
          path: 'persons',
          name: 'persons',
          component: Person,
          meta: {
            middlewareAuth: true
          }
        },
        {
          path: 'positions',
          name: 'positions',
          component: Position,
          meta: {
            middlewareAuth: true
          }
        },
        {
          path: 'persontypes',
          name: 'persontypes',
          component: PersonType,
          meta: {
            middlewareAuth: true
          }
        }
      ]
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.middlewareAuth)) {
    if (!auth.check()) {
      next({
        path: '/login',
        query: {
          redirect: to.fullPath
        }
      });
      return;
    }
  }
  next();
})

export default router