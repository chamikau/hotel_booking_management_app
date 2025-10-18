import { createRouter, createWebHistory } from 'vue-router'

import RoomSearch from './views/pages/RoomSearch.vue'
import Rooms from './views/pages/Rooms.vue'
import ContactInfo from './views/pages/ContactInfo.vue'
import Confirmation from './views/pages/Confirmation.vue'
import Login from './views/pages/Login.vue'
import Register from './views/pages/Register.vue'
import UserDashboard from './views/pages/UserDashboard.vue'

const routes = [
    { path: '/', name: 'RoomSearch', component: RoomSearch },
    { path: '/rooms', name: 'Rooms', component: Rooms },
    { path: '/contact-info', name: 'ContactInfo', component: ContactInfo },
    { path: '/confirmation', name: 'Confirmation', component: Confirmation },
    { path: '/login', name: 'Login', component: Login },
    { path: '/register', name: 'Register', component: Register },
    { path: '/dashboard', name: 'UserDashboard', component: UserDashboard },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
