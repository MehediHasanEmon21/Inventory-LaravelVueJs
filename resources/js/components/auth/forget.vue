<template>

<div>
	 <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Forgrt Password</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Existing Email address</label>
            </div>
          </div>
       

          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
        <div class="text-center">
          <router-link to="/register" class="d-block small mt-3">Register an Account</router-link>
          <router-link to="/" class="d-block small">Already have account?</router-link>
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script type="text/javascript"></script>

<style type="text/css"></style>