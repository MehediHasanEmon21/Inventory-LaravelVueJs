<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Category Edit 
            <router-link to="/all-category" class="btn btn-sm btn-info" id="add_new"> All Category</router-link>
          </div>
          <div class="card-body">
          	   <form @submit.prevent="updateCategory">

   				<div class="form-group">
	              <div class="form-row">
	               <div class="col-md-12">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.name" class="form-control">
	                  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
	                  <label for="firstName">Category Name</label>
	                </div>
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
				},
				errors: {},
			}
		},

		created(){
			let id = this.$route.params.id
			axios.get('/api/category/'+id)
			.then(({data}) => this.form = data)
			.catch(error => console.log(error))
		},

		methods: {
			updateCategory(){
				let id = this.$route.params.id
				axios.patch('/api/category/'+id,this.form)
				.then(() => {
					Notification.success()
					this.$router.push({name: 'all-category'})
				})
				.catch(error => this.errors = error.response.data.errors)
			},

			
		}

	}
  
</script>

<style>
	
#add_new{
	float: right;
}
</style>