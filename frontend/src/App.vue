<template>
  <v-app>
    
    <v-toolbar app color="blue" dark>
      <v-toolbar-side-icon @click="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>Giffits</v-toolbar-title>
    </v-toolbar>
    <v-content>
      <router-view></router-view>
    </v-content>
    <v-navigation-drawer v-model="drawer" app>
      <v-list>
        <v-list-tile to="/">
          <v-list-tile-action>
            <v-icon>home</v-icon>
          </v-list-tile-action>
          <v-list-tile-title>Principal</v-list-tile-title>
        </v-list-tile>
        <v-list-tile to="/usuarios">
          <v-list-tile-action>
            <v-icon>group</v-icon>
          </v-list-tile-action>
          <v-list-tile-title>Usuarios</v-list-tile-title>
        </v-list-tile>
      </v-list>
      
    </v-navigation-drawer>
  </v-app>
</template>

<script>
export default {  
  data () {
    return {
      drawer:false
    }
  }
}
</script>
