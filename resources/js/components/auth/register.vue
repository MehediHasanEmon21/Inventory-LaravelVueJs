<template>

<div>
	  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form @submit.prevent="signup">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" id="name" class="form-control" placeholder="First name" autofocus="autofocus" v-model="form.name">
                  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  <label for="name">Full Name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" v-model="form.email">
              <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password"  v-model="form.password">
                   <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" v-model="form.password_confirmation" placeholder="Confirm password">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div class="text-center">
          <router-link to='/' class="d-block small mt-3">Already have account?</router-link>
          <router-link to='/forget' class="d-block small" href="forgot-password.html">Forgot Password?</router-link>
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script type="text/javascript">
  
  export default {
    data(){
      return{

        form: {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
        },
        errors: {},

      }
    },
    methods: {
      signup(){
        axios.post('/api/auth/signup/',this.form)
        .then(res => {
          User.responseAfterLogin(res)
          Toast.fire({
            type: 'success',
            title: 'Signed in successfully'
          })
          this.$router.push({name: 'home'})
        })
        .catch(error => this.errors = error.response.data.errors)
      }
    }
  }

</script>

<style type="text/css"></style>