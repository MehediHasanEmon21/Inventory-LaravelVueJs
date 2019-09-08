 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Category</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Category  
            <router-link to="/add-category" class="btn btn-sm btn-info" id="add_new"> Add New</router-link>
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="table-responsive">
                <label>Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                
                  <tbody>

                    <tr v-for="category in filterCategories" :key="category.id">
                      <td>{{ category.id }}</td>
                      <td>{{ category.name }}</td>
                      <td>
                    	<router-link :to="{ name: 'edit-category', params: {id: category.id} }" class="btn btn-info btn-sm">Edit</router-link>
                    	<a @click="categoryDelete(category.id)" class="btn btn-danger btn-sm">Delete</a>
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

    	created(){
    		if (!User.loggedIn()) {
    			this.$router.push({name: '/'})
    		}
    	},

    	data(){
    		return {
    			categories: [],
    			searchTerm: '',
    		}
    	},

    	mounted(){
    		this.allCategory()
    	},

    	computed: {
    		filterCategories(){
    			return this.categories = this.categories.filter(category => {
    				return category.name.match(this.searchTerm)
    			})
    		}
    	},

    	methods: {
    		allCategory(){
    			axios.get('/api/category')
    			.then(({data}) => this.categories = data)
    			.catch(error => console.log(error))
    		},
    		categoryDelete(id){

				
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
	              axios.delete('/api/category/'+id)
	              .then(()=>{
	                 this.categories = this.categories.filter(category =>{
	                    return category.id !=id
	                 })
	              })
	              .catch(()=>{
	                 this.$router.push({name: 'all-category'})
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