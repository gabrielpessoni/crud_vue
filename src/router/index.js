import Vue from 'vue'
import VueRouter from 'vue-router'

import CriarItem from '../components/Criar-Item.vue'
import EditarItem from '../components/Editar-Item.vue'
import ListarItem from '../components/Listar-Item.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: ListarItem
  },
  {
    path: '/criar',
    name: 'Criar',
    component: CriarItem
  },
  {
    path: '/editar/:id',
    name: 'Editar',
    component: EditarItem
  },
  {
    path: '/listar',
    name: 'Listar',
    component: ListarItem
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
