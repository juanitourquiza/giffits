<template>
  <v-container>
    <v-layout justify-center>
      <v-flex xs12 sm8 md6>
        <v-card>
          <v-toolbar color="green" dark flat>
            <v-toolbar-title>LISTA DE USUARIOS</v-toolbar-title>
          </v-toolbar>
          <ul>
            <ul>
              <li
                v-for="(value, key, index) in usuarios"
                :key="key"
              >{{ index }}. {{ key }} - {{ value }}</li>
            </ul>
            <li
                v-for="(value, key, index) in personal"
                :key="key"
              >{{ index }}. {{ key }} - {{ value }}</li>
            </ul>
          </ul>
        </v-card>
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
      .get("http://127.0.0.1:8000/api/personals")
      .then(response => {
        this.usuarios = response.data;
        console.log(this.usuarios);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>

<style></style>
