 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Supplier</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Supplier  
            <router-link to="/add-supplier" class="btn btn-sm btn-info" id="add_new"> Add New</router-link>
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="table-responsive">
                <label>Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Shop Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                
                  <tbody>

                    <tr v-for="supplier in filterSuppliers" :key="supplier.id">
                      <td>{{ supplier.name }}</td>
                      <td><img :src="supplier.image" id="em_photo"></td>
                      <td>{{ supplier.phone }}</td>
                      <td>{{ supplier.address }}</td>
                      <td>{{ supplier.shop_name }}</td>
                      <td>
                    	<router-link :to="{ name: 'edit-supplier', params: {id: supplier.id} }" class="btn btn-info btn-sm">Edit</router-link>
                    	<a @click="supplierDelete(supplier.id)" class="btn btn-danger btn-sm">Delete</a>
                      </td>
                    </tr>
        
                  </tbody>
                </table>
              </div>
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
    			suppliers: [],
    			searchTerm: '',
    		}
    	},

    	created(){
    		this.allSupplier()
    	},

    	computed: {
    		filterSuppliers(){
    			return this.suppliers = this.suppliers.filter(supplier => {
    				return supplier.name.match(this.searchTerm)
    			})
    		}
    	},

    	methods: {
    		allSupplier(){
    			axios.get('/api/supplier')
    			.then(({data}) => this.suppliers = data)
    			.catch(error => console.log(error))
    		},
    		supplierDelete(id){

				
	            Swal.fire({
	            title: 'Are you sure?',
	            text: "You won't be able to revert this!",
	            type: 'warning',
	            showCancelButton: true,
	            confirmButtonColor: '#3085d6',
	            cancelButtonColor: '#d33',
	            confirmButtonText: 'Yes, delete it!'
	          }).then((result) => {
	            if (result.value) {
	              axios.delete('/api/supplier/'+id)
	              .then(()=>{
	                 this.suppliers = this.suppliers.filter(supplier =>{
	                    return supplier.id !=id
	                 })
	              })
	              .catch(()=>{
	                 this.$router.push({name: 'all-supplier'})
	              })
	              Swal.fire(
	                'Deleted!',
	                'Your file has been deleted.',
	                'success'
	              )
	            }
	           })
    		}
    	}



        
      
    }
     
  
  
</script>

<style>
	
#add_new{
	float: right;
}
#em_photo{
  height: 40px;
  width: 40px;
}
</style>