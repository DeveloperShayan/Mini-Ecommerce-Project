import {createRouter, createWebHistory } from 'vue-router'
import Login from './components/Login.vue'
import Header from './components/Header.vue'
const routes = [
    {
        name : 'Home',
        path : '/',
        component : Header,

        
    },
    {
        name : 'Login',
        path:'/login',
        component: Login,
    }
];


const router=createRouter ({
    history :createWebHistory(),
    routes

});

// router.beforeEach((to) => {
//     if(to.meta.requiresAuth && !localStorage.getItem('user-info')){
//             return{name:'Login'}
//     }
//     if(to.meta.requiresAuth == false && localStorage.getItem('user-info')){
//         return{name:'Home'}
// }
// })

export default router;