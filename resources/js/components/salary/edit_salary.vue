<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Salary Edit 
            <router-link to="/all-salary" class="btn btn-sm btn-info" id="add_new"> All Salary</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="updateSalary" enctype="multipart/form-data">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.name" class="form-control">
	                  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
	                  <label for="firstName">Full Name</label>
	                </div>
	               </div>
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.email" class="form-control" >
	                  <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
	                  <label for="lastName">Email Address</label>
	                </div>
	               </div>
	             </div>
	          </div>
	          <div class="form-group">
	              <div class="form-row">
	                <div class="col-md-6">
	                  <div class="form-group">
					   
					    <select class="form-control" id="exampleFormControlSelect1" v-model="form.salary_month">
					      <option value="January">January</option>
					      <option value="February">February</option>
					      <option value="March">March</option>
					      <option value="April">April</option>
					      <option value="May">May</option>
					      <option value="June">June</option>
					      <option value="July">July</option>
					      <option value="August">August</option>
					      <option value="September">September</option>
					      <option value="October">October</option>
					      <option value="November">November</option>
					      <option value="Devember">Devember</option>
					    </select>
					    <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
					  </div>
	               </div>
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.amount" class="form-control">
	                  <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
	                  <label for="lastName">Salary</label>
	                </div>
	               </div>
	               <div>
	               	<input type="hidden" v-model="form.employee_id">
	               </div>
	             </div>
	          </div>
	         
             

               <button type="submit" class="btn btn-success">Update</button>
              </form>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
         </div>
       </div>
   </div>
</template>

<script>

	export default {
		mounted(){
			if (!User.loggedIn()) {
				this.$router.push({name: '/'})
			}
		},
		data(){
			return {
				form: {
					name: '',
					email: '',
					amount: '',
					salary_month: '',
					employee_id: '',
					
				},
				errors: {},

			}
		},

		created(){

			let id = this.$route.params.id
			axios.get('/api/edit/salary/'+id)
			.then(({data}) => this.form = data )
			.catch(error => console.log(error))

		},

		methods: {
			
			updateSalary(){
				let id = this.$route.params.id
				axios.post('/api/update/salary/'+id,this.form)
				.then(() => {
					Notification.success()
					this.$router.push({name: 'all-salary'})
				})
				.catch()
			}
			
		}

	}
  
</script>

<style>
	
#add_new{
	float: right;
}
</style>