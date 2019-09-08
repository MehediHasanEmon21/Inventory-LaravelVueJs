<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Customer</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Customer Insert 
            <router-link to="/all-customer" class="btn btn-sm btn-info" id="add_new"> All Customer</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="customerInsert" enctype="multipart/form-data">
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
	                <div class="form-label-group">
	                  <input type="text" v-model="form.phone" class="form-control">
	                  <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
	                  <label for="firstName">Phone</label>
	                </div>
	               </div>
	                <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.address" class="form-control"  autofocus="autofocus">
	                  <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
	                  <label for="firstName">Address</label>
	                </div>
	               </div>
	             </div>
	          </div>
	   
               <div class="form-group">
	              <div class="form-row">
	               

	               <div class="col-md-6">
	                <div class="form-label-group">
	                 <input type="file" class="btn btn-info" @change="OnFileSelected">
	                </div>
	               </div>
	               <div class="col-md-6">
	               		<img :src="form.image" style="height: 50px; width: 50px;">
	               </div>
	             </div>
	          </div>

               <button type="submit" class="btn btn-success">Submit</button>
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
				this.$router.push({name:'/'})
			}
		},
		data(){
			return {
				form: {
					name: '',
					email: '',
					phone: '',
					address: '',
					image: '',
				},
				errors: {},
			}
		},

		methods: {
			customerInsert(){
				axios.post('/api/customer/',this.form)
				.then(() => {
					Notification.success()
					this.$router.push({name: 'all-customer'})
				})
				.catch(error => this.errors = error.response.data.errors)
			},
			OnFileSelected(event){
				let file = event.target.files[0];
				if (file.size > 1048770) {
					Notification.image_validation();
				}else{
					let reader = new FileReader();
					reader.onload = event => {
						this.form.image = event.target.result
						console.log(event.target.result)
					}
					reader.readAsDataURL(file) 
				}
			}
		}

	}
  
</script>

<style>
	
#add_new{
	float: right;
}
</style>