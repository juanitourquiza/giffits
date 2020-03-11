<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="title">Nombre</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="tutorial.name"
          name="name"
        />
      </div>

      <div class="form-group">
        <label for="description">Apellido</label>
        <input
          class="form-control"
          id="lastname"
          required
          v-model="tutorial.lastname"
          name="lastname"
        />
      </div>

      <div class="form-group">
        <label for="description">Email</label>
        <input class="form-control" id="email" required v-model="tutorial.email" name="email" />
      </div>

      <div class="form-group">
        <label for="description">CI</label>
        <input class="form-control" id="ci" required v-model="tutorial.ci" name="ci" />
      </div>

      <button @click="saveTutorial" class="btn btn-success">Submit</button>
    </div>

    <div v-else>
      <h4>You submitted successfully!</h4>
      <button class="btn btn-success" @click="newTutorial">Add</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
//import TutorialDataService from "../services/TutorialDataService";

export default {
  name: "add-tutorial",
  data() {
    return {
      tutorial: {
        id: null,
        name: "",
        lastname: "",
        email: "",
        ci: ""
      },
      submitted: false
    };
  },
  methods: {
    saveTutorial() {
      var data = {
        name: this.tutorial.name,
        lastname: this.tutorial.lastname,
        email: this.tutorial.email,
        ci: this.tutorial.ci
      };
      /*
      TutorialDataService.create(data)
        .then(response => {
          this.tutorial.id = response.data.id;
          console.log(response.data);
        })
        .catch(e => {
          console.log(e);
        });
      */
      //console.log(data);
      let json = JSON.stringify(data);
      let params = "json=" + json;
      let headers = new Headers({
        "Content-Type": "application/x-www-form-urlencoded"
      });
      axios
        .post("http://127.0.0.1:8000/apis/personal", params, {
          header: headers
        })
        .then(response => {
          this.tutorial.id = response.data.id;
          console.log(response.data);
        })
        .catch(error => {
          console.log(error);
        });
      this.submitted = true;
    },

    newTutorial() {
      this.submitted = false;
      this.tutorial = {};
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
