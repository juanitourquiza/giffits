import VueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(VueRouter)

import Home from './components/Home.vue'
import Usuarios from './components/Usuarios.vue'
import UsuarioInfo from './components/UsuarioInfo.vue'
import ListaTareas from './components/ListaTareas.vue'
import Error404 from './components/Error404.vue'

const rutas = [
    {
        path:'/',
        component:Home 
    },
    {
        path:'/usuarios',
        component:Usuarios
    },
    {
        path:'/usuarios/:id',
        component:UsuarioInfo,
        /*
            Cuando se trata de rutas anidadas,
            necesita un nuevo router-view donde se renderizará 
            DENTRO DEL COMPONENTE PADRE
        
        children:[
            {
                path:'tareas',
                component:ListaTareas
            }
        ]*/
    },
    {
        path:'/usuarios/:id/tareas',
        component:ListaTareas,
        name:'listaTareas'
    },
    {
        path:'/users',
        redirect:'/usuarios'
    },
    {
        path:'*',
        component:Error404
    }
]


export default new VueRouter(
    {
        routes: rutas,
        mode:'history'
    }
)