<template>
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 mt-5">
      <div class="card card-outline card-primary">
        <div class="card-header">Sign In </div>
        <div class="card-body">

          <form @submit.prevent="login">
            <div class="input-group my-3">
              <input type="text" class="form-control" v-model="form.email" placeholder="Email" />
            </div>
              <span v-if="errors.email" class="text-danger ">{{errors.email[0]}}</span>
            <div class="input-group my-3">
              <input type="password" class="form-control" v-model="form.password" placeholder="Password" />
            </div>
              <span v-if="errors.password" class="text-danger">{{errors.password[0]}}</span>
            <div class="row">
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>

                <router-link to="/register" class="mt-3">Sign up</router-link>

              </div>
              <!-- /.col -->
            </div>
          </form>

        </div>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
</template>

<script>
export default {
    data(){
        return {
          form: {
            email: '',
            password: '',
          },
          errors: {

          }
        }
    },
    methods: {
      login(){
        axios.post('/api/login', this.form)
        .then(res => {
          if(res.data.type == 1){
            localStorage.setItem('access_token', res.data.token)
            this.$store.dispatch('login', res.data)
            localStorage.setItem('user', JSON.stringify( res.data.user))
            this.$router.push('/')
          }else{
            alert(res.data.message)
          }
        })
        .catch(err => {
          this.errors = err.response.data.errors
        })
      }
    },

    mounted(){

      if(this.$store.state.authenticated){
            this.$router.push('/')
      }

    }
};
</script>

<style>
</style>