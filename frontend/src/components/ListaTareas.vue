<template>
    <v-container>
        <v-layout> 
            <v-flex>
                <panel  :titulo="`Tareas de ${nombreUsuario}`">
                    <v-list>
                        <v-list-tile v-for="tarea in tareas" :key="tarea.id">
                            <v-checkbox v-model="tarea.completed" :label="tarea.title"/>
                        </v-list-tile>
                    </v-list>
                </panel>
            </v-flex>
        </v-layout>
    </v-container>    
</template>

<script>
import axios from 'axios'
import Panel from './Panel.vue'
export default {
    components:{Panel},
    data(){
        return {
            nombreUsuario : '',
            tareas:[]
        }
    },
    beforeMount(){
        var id = this.$route.params.id
        axios.get(`https://jsonplaceholder.typicode.com/users/${id}`)
        .then((response)=>{
            this.nombreUsuario = response.data.name
        }).catch((error)=>{
            console.log(error)
        })
        axios.get(`https://jsonplaceholder.typicode.com/todos?userId=${id}`)
        .then((response)=>{
            var completed = this.$route.query.completed
            if(completed === 'true'){
                this.tareas = response.data.filter(tarea => tarea.completed)
            }
            else if(completed === 'false'){
                this.tareas = response.data.filter(tarea => !tarea.completed)
            }
            else{
                this.tareas = response.data
            }
            
        }).catch((error)=>{
            console.log(error)
        })
    }
}
</script>

<style>

</style>
