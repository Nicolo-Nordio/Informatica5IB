import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/tags',
        name: 'tags',
        component: () => import('../views/TagManager.vue')
    },
    {
        path: '/note/:id',
        name: 'note',
        component: () => import('../views/NoteView.vue'),
        props: true
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

export default router