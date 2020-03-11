<template>
  <v-container fill-height>
    <v-layout align-center justify-center>
      <v-flex class="text-xs-center">
        <h4>El Usuario se borro de la base de datos</h4>
        <router-link to="/usuarios">Ir a usuarios</router-link>
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
  }
};
</script>

<style></style>
