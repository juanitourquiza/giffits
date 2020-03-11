<template>
  <v-container grid-list-lg>
    <v-layout wrap>
      <v-flex xs12>
        <v-btn to="/usuarios" color="primary">Listado</v-btn>
        <v-btn :to="`${$route.params.id}/tareas`" color="green" dark
          >Borrar</v-btn
        >
        <v-btn @click="irTareasProgramatico" color="brown" dark>Editar</v-btn>
      </v-flex>
      <v-flex xs12 sm12>
        <panel titulo="Información General">
          <div v-for="item in usuario" :key="item.id">
            <div>
              <span class="title">Nombre:</span>
              <span class="subheading">{{ item.name }}</span>
            </div>
            <div class="mt-2">
              <span class="title">Apellido:</span>
              <span class="subheading">{{ item.lastname }}</span>
            </div>
            <div class="mt-2">
              <span class="title">Email:</span>
              <span class="subheading">{{ item.email }}</span>
            </div>
            <div class="mt-2">
              <span class="title">Ci:</span>
              <span class="subheading">{{ item.ci }}</span>
            </div>
          </div>
        </panel>
      </v-flex>

      <v-flex xs12>
        <router-view />
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
import Panel from "./Panel.vue";
export default {
  components: {
    Panel
  },
  data() {
    return {
      usuario: {}
    };
  },
  beforeMount() {
    var id = this.$route.params.id;
    axios
      .delete(`http://127.0.0.1:8000/apis/personal/${id}`)
      .then(response => {
        this.usuario = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  },
  methods: {
    irTareasProgramatico() {
      var id = this.$route.params.id;
      // pasandole un string
      //this.$router.push(`/usuarios/${id}/tareas`)
      // pasando un objeto
      /*this.$router.push({
                path:`/usuarios/${id}/tareas`
            })*/
      //Usar rutas nombradas
      this.$router.push({
        name: "listaTareas",
        params: {
          id: id
        }
      });
    }
  }
};
</script>

<style></style>
