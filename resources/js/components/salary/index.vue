 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All  Salary</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Salary  
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="table-responsive">
                <label>Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Month</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                
                  <tbody>

                    <tr v-for="salary in filterSalaries" :key="salary.id">
                      <td>{{ salary.salary_month }}</td>
                      <td>
                    	<router-link :to="{ name: 'view-salary', params: {month: salary.salary_month} }" class="btn btn-info btn-sm">View Salary</router-link>
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
    			salaries: [],
    			searchTerm: '',
    		}
    	},

    	created(){
    		this.allSalary()
    	},

    	computed: {
    		filterSalaries(){
    			return this.salaries = this.salaries.filter(salary => {
    				return salary.salary_month.match(this.searchTerm)
    			})
    		}
    	},

    	methods: {
    		allSalary(){
    			axios.get('/api/all/salary')
    			.then(({data}) => this.salaries = data)
    			.catch(error => console.log(error))
    		},
    	
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