import Vue from 'vue'
import VueRouter from 'vue-router'

import VideoList from './pages/VideoList.vue'
import Login from './pages/Login.vue'
import SearchVideo from './pages/SearchVideo.vue'
import SystemError from './pages/errors/System.vue'

import store from './store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    component: VideoList,
  },
  {
    path: '/login',
    component: Login,
    beforeEnter (to, from, next) {
      if(store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/search',
    component: SearchVideo,
  },
  {
    path:'/500',
    component: SystemError,
  }
]

const router = new VueRouter({
  mode: 'history',
  routes,
})

export default router
