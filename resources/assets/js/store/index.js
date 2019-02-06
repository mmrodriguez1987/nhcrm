import Vue from 'vue'
import Vuex from 'vuex'
import Person from './modules/person.js'
//import PersonType from './modules/persontype.js'
//import Position from './modules/position.js'

Vue.use(Vuex)

let store = new Vuex.Store({
  modules: {
    Person,
    //PersonType,
    //Position,
  }
})

export default store
