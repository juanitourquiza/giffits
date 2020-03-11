<template>
  <v-container>
    <v-layout justify-center>
      <v-flex xs12>
        <v-card>
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>Usuarios</v-toolbar-title>
          </v-toolbar>
          <v-list>
            <v-list-tile
              :to="`/usuarios/${usuario.id}`"
              v-for="usuario in usuarios"
              :key="usuario.id"
            >{{ usuario.name }} {{ usuario.lastname }}</v-list-tile>
          </v-list>
        </v-card>
        <v-btn to="/usuariosagregar" color="primary">Nuevo</v-btn>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      usuarios: []
    };
  },
  beforeMount() {
    axios
      .get("http://127.0.0.1:8000/apis/personal")
      .then(response => {
        this.usuarios = response.data;
        console.log(response.data);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>

<style></style>
