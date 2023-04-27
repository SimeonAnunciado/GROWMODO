import { createStore } from 'vuex'


const store = createStore({
    state: {
      authenticated: false,
      access_token:null,
      user: null
    },

    getters:{
      getUser(state){
        return state.user
      }

    },

    mutations: {
      init(state, data){
       state.authenticated = data != null ? true : false
       state.user = localStorage.getItem('user') != null ? JSON.parse(localStorage.getItem('user')) : ''
      },

      login(state, data){
        state.authenticated = localStorage.getItem('access_token') != null ? true : false
        state.user = localStorage.getItem('user') != null ? JSON.parse(localStorage.getItem('user')) : ''
        state.access_token = data.token
      },

      logout(state, data){
        state.authenticated = false
      },
    },

    actions: {

      login({commit} , data){
        commit('login', data)
      },

      logout({commit}, data){
        commit('logout',data)
      },

      initialized({commit}, data){
        commit('init',data)
      }

    }
  })
  export default store