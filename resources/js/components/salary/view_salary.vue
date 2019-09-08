 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All  Monthly Salary</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Salary  
            <router-link to="/all-salary" class="btn btn-sm btn-info" id="add_new"> All Salary</router-link>
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
                      <th>Date</th>
                      <th>Month</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                
                  <tbody>

                    <tr v-for="salary in salaries" :key="salary.id">
                      <td>{{ salary.name }}</td>
                      <td>{{ salary.salary_date }}</td>
                      <td>{{ salary.salary_month }}</td>
                      <td>{{ salary.amount }}</td>
                      <td>
                    	<router-link :to="{ name: 'edit-salary', params: {id: salary.id} }" class="btn btn-info btn-sm">Edit Salary</router-link>
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
    		this.allMonthlySalary()
    	},

    	computed: {
    		filterSalaries(){
    			return this.salaries = this.salaries.filter(salary => {
    				return salary.salary_month.match(this.searchTerm)
    			})
    		}
    	},

    	methods: {
    		allMonthlySalary(){
          let month = this.$route.params.month
    			axios.get('/api/view/salary/'+month)
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