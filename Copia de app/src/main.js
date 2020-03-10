import Vue from 'vue'
import './plugins/vuetify'
import App from './App.vue'
import enrutador from './enrutador'

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router:enrutador
}).$mount('#app')
