<template>
  <v-container grid-list-lg>
    <v-layout wrap>
      <!-- v-for="item in usuario" :key="item.id" -->
      <v-flex xs12>
        <v-btn to="/usuarios" color="primary">Listado</v-btn>
      </v-flex>

      <v-flex xs12 sm12>
        <panel titulo="Editar Información General">
          <div v-if="!submitted">
            <div>
              <v-text-field
                label="Nombre"
                placeholder="Ingrese su nombre"
                id="name"
                required
                v-model="item.name"
                name="name"
              ></v-text-field>
            </div>
            <div class="mt-2">
              <v-text-field
                label="Apellido"
                placeholder="Ingrese su apellido"
                id="lastname"
                required
                v-model="item.lastname"
                name="lastname"
              ></v-text-field>
            </div>
            <div class="mt-2">
              <v-text-field
                label="Email"
                placeholder="Ingrese su email"
                id="email"
                required
                v-model="item.email"
                name="email"
              ></v-text-field>
            </div>
            <div class="mt-2">
              <v-text-field
                label="CI"
                placeholder="Ingrese su ci"
                id="ci"
                required
                v-model="item.ci"
                name="ci"
              ></v-text-field>
            </div>
            <v-btn @click="editarUsuario" color="brown">Editar</v-btn>
          </div>

          <div v-else>
            <h4>Usuario Editado!</h4>
            <v-btn color="blue" @click="newUsuario">Agregar</v-btn>
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
  name: "editar-usuario",
  data() {
    return {
      item: {
        id: null,
        name: "",
        lastname: "",
        email: "",
        ci: ""
      },
      submitted: false
      //usuario: {}
    };
  },
  beforeMount() {
    var id = this.$route.params.id;
    axios
      .get(`http://127.0.0.1:8000/apis/personal/${id}`)
      .then(response => {
        this.usuario = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  },
  methods: {
    editarUsuario() {
      var id = this.$route.params.id;
      var data = {
        name: this.item.name,
        lastname: this.item.lastname,
        email: this.item.email,
        ci: this.item.ci
      };

      console.log(data);
      let json = JSON.stringify(data);
      let params = "json=" + json;
      let headers = new Headers({
        "Content-Type": "application/x-www-form-urlencoded"
      });
      axios
        .put(`http://127.0.0.1:8000/apis/personal/${id}`, params, {
          header: headers
        })
        .then(response => {
          this.item.id = response.data.id;
        })
        .catch(error => {
          console.log(error);
        });
      this.submitted = true;
    },

    newUsuario() {
      this.submitted = false;
      this.item = {};
    }
  }
};
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>
