<template>
  <v-container grid-list-lg>
    <v-layout wrap>
      <v-flex xs12>
        <v-btn to="/usuarios" color="primary">REGRESAR</v-btn>
        <v-btn :to="`${$route.params.id}/tareas`" color="green" dark
          >VER TAREAS</v-btn
        >
        <v-btn @click="irTareasProgramatico" color="brown" dark
          >VER TAREAS PROGRAMÁTICO</v-btn
        >
      </v-flex>
      <v-flex xs12 sm12 md6>
        <panel titulo="Información General">
          <div>
            <span class="title">Nombre: </span>
            <span class="subheading">{{ usuario.name }}</span>
          </div>
          <div class="mt-2">
            <span class="title">Usuario: </span>
            <span class="subheading">{{ usuario.username }}</span>
          </div>
          <div class="mt-2">
            <span class="title">Email: </span>
            <span class="subheading">{{ usuario.email }}</span>
          </div>
          <div class="mt-2">
            <span class="title">Teléfono: </span>
            <span class="subheading">{{ usuario.phone }}</span>
          </div>
        </panel>
      </v-flex>
      <v-flex xs12 sm12 md6>
        <panel titulo="Dirección">
          <div>
            <span class="title">Calle: </span>
            <span class="subheading">{{ usuario.address.street }}</span>
          </div>
          <div class="mt-2">
            <span class="title">Suite: </span>
            <span class="subheading">{{ usuario.address.suite }}</span>
          </div>
          <div class="mt-2">
            <span class="title">Ciudad: </span>
            <span class="subheading">{{ usuario.address.city }}</span>
          </div>
          <div class="mt-2">
            <span class="title">Zipcode: </span>
            <span class="subheading">{{ usuario.address.zipcode }}</span>
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
      usuario: {
        address: {}
      }
    };
  },
  beforeMount() {
    var id = this.$route.params.id;
    axios
      .get(`http://127.0.0.1:8000/api/personals/${id}`)
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
