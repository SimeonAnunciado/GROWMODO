<template>
  <div>
      <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light mx-5">DASHBOARD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <router-link to="/" class="nav-link"> Home</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/user" class="nav-link" v-if="$store.getters.getUser.role == 1" > View Records </router-link>
            <a @click="unsubscribe($store.getters.getUser.id)" class="nav-link" v-if="$store.getters.getUser.role == 0" > Unsubscribe</a>
          </li>
          <li class="nav-item">
            <a @click="logout" style="cursor:pointer" class="nav-link">Logout</a>
          </li>
        </ul>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  </div>
</template>

<script>
export default {
  data(){
    return{
      user : null
    }
  },
  methods: {
    unsubscribe(id){
       axios.post('/api/users/unsubscribe', { id })
      .then(res => {
        if(res.data.type){
          localStorage.removeItem('access_token')
          localStorage.removeItem('user')
          this.$store.dispatch('logout',{})
          this.$router.push({name: 'login'})
          alert(res.data.message)
        }
      })
      .catch(err => {
        let statusCode = err.response.request.status
      })

    },
    logout(){
      axios.post('/api/logout')
      .then(res => {
          localStorage.removeItem('access_token')
          localStorage.removeItem('user')
          this.$router.push({name: 'login'})
          this.$store.dispatch('logout',{})

      })
      .catch(err => {
        let statusCode = err.response.request.status
        if(statusCode == 401 ){
            localStorage.removeItem('access_token')
            this.$router.push({name: 'login'})
            this.$store.dispatch('logout',{})
        }
      })
    }
  },
  mounted() {
    let token = localStorage.getItem('access_token')
    if(token != null) {
      window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}` ;
      this.$store.dispatch('initialized', localStorage.getItem('access_token'))
    }
  },
}
</script>

<style>

</style>