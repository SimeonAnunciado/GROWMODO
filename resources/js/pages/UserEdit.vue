<template>
    <div class="col-md-2"></div>
    <div class="col-md-8 mt-5">
      <div class="card card-outline card-primary">
        <div class="card-header">User</div>
        <div class="card-body">
          <form @submit.prevent="update" >

              <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="user.name " placeholder="Name" />
              </div>
                <span v-if="errors.name" class="text-danger ">{{errors.name[0]}}</span>

              <div class="input-group mb-3">
                <input type="text" class="form-control"  v-model="user.email" placeholder="Email" />
              </div>
              <span v-if="errors.email" class="text-danger ">{{errors.email[0]}}</span>

              <div class="input-group mb-3">
                <input type="text" class="form-control"  v-model="user.phone" placeholder="Phone" />
              </div>

              <span v-if="errors.email" class="text-danger ">{{errors.phone[0]}}</span>
              <button class="btn btn-success float-right btn-sm">Update</button>

          </form>


        </div>
        <!-- /.card-body -->
      </div>
    </div>

</template>

<script>

export default {

  data(){
    return {
      user: {},
      errors: {}
    }
  },
  methods: {
    getUser(){
      axios.get(`/api/users/${this.$route.params.id}/edit`)
      .then(res => {
        if(res.data.type){
          this.user = res.data.data
        }
      })
      .catch(err => console.log(err))
    },

    update(){
      axios.post(`/api/users/${this.$route.params.id}/update`, this.user )
      .then(res => {
        if(res.data.type){
          alert(res.data.message)
          this.$router.push('/user')
        }
      })
      .catch(err => console.log(err))
    },
  },

   mounted() {
      this.$store.dispatch('initialized', localStorage.getItem('access_token'))
      this.getUser()
    },
};
</script>

<style scoped>

</style>