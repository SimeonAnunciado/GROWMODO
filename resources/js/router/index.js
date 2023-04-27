import { createRouter , createWebHistory} from 'vue-router';
import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/Register.vue'

import User from '../pages/User.vue'
import UserEdit from '../pages/UserEdit.vue'


const Router = createRouter({
    history: createWebHistory(),
    routes : [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/user/:id/edit',
            name: 'user-edit',
            component: UserEdit
        },
        {
            path: '/user',
            name: 'user',
            component: User
        },
    ]

})

export default Router