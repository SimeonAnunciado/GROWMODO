<template>
      <div class="col-md-2"></div>
      <div class="col-md-8 mb-5">

        <div>  <h1>Users</h1> </div>

        <div class="card" v-for="user in users" :key="user.id">
            <div class="card-header">
                id:  {{ user.id }}
                <div class="float-right">
                <router-link :to="{ path:`/user/${user.id}/edit` }" class="text-success " style="cursor-pointer" ><i class="nav-icon fas fa-pencil-alt"></i> edit </router-link>
                 &nbsp;&nbsp; <span class="text-danger" style="cursor-pointer" @click="remove(user)"><i class="nav-icon fas fa-trash-alt"></i> remove</span>
              </div>
            </div>
            <div class="card-body">
                <p class="card-text">name:  {{ user.name }}</p>
                <p class="card-text">phone:  {{ user.phone }}</p>
                <p class="card-text">email:  {{ user.email }}.</p>
            </div>
        </div>

      </div>
</template>

<script>


export default {
  data() {
    return {
      users: null
    };
  },
  methods: {
    getUsers(){
      axios
      .get(`/api/users`)
      .then(res=> {
        let result = res.data.data;
        this.users = result
      })
      .catch( err => console.log(err));
    },

    remove(user){
      axios.post(`/api/users/destroy`, { 'id' :user.id })
      .then(res => {
        if(res.data.type){
          // remove index after deltion
          alert(res.data.message)
          let index = this.users.indexOf(user)
          this.users.splice(index, 1)
          this.getUsers();
        }
      })
      .catch(err => console.log(err))
    }


  },

  mounted() {
    let token = localStorage.getItem('access_token')
    if(token != null) {
      window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}` ;
      this.getUsers()
      this.$store.dispatch('initialized', localStorage.getItem('access_token'))
    }
  },

};
</script>

<style>
</style>