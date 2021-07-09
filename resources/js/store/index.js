import Vue from 'vue'
import Vuex from 'vuex'

import currentUser from './modules/currentUser'
import todo from './modules/todo'

Vue.use(Vuex)

export default new Vuex.Store({
    modules : {
        currentUser,
        todo
    }
})