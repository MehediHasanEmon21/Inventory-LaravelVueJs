 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Stock</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Stock Update 
            <router-link to="/stock" class="btn btn-sm btn-info" id="add_new"> All Stock</router-link>
          </div>
          <div class="card-body">
             	  <form @submit.prevent="stockUpdate" enctype="multipart/form-data">
              
   	      
   	          <div class="form-group">
   	              <div class="form-row">
   	               <div class="col-md-12">
   	                <div class="form-label-group">
   	                  <input type="text" v-model="form.product_quantity" class="form-control"  required="">
   	                  <label for="phone">Quantity  </label>
   	                  <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
   	                </div>
   	               </div>
   	             </div>
   	          </div><br>
               
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
               this.$router.push({ name:'/' })
            } 
        },
        data(){
        	return{
        		form:{
        			product_quantity:''
        		},
        		errors:{},
        	}
        },
        created(){
        	let id = this.$route.params.id
        	axios.get('/api/product/'+id)
        	.then(({data}) => (this.form = data))
        	.catch()
       
        },
        methods:{ 	
  
        	stockUpdate(){
        		let id = this.$route.params.id
        		axios.post('/api/stock/update/'+id,this.form)
        		.then(() => {
        			this.$router.push({ name: 'stock' })
        			Notification.success()
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