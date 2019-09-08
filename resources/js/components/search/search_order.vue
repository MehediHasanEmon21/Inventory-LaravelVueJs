<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Order</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Search Order
          </div>
          <div class="card-body">
			  <div class="row">

				  	<div class="col-md-6">
	          	  	<form @submit.prevent="searchOrder">
		                <div class="form-group">
			              <div class="form-row">
			               <div class="col-md-12">
			         
			                  <input type="date" v-model="date" class="form-control">
			                  <small class="text-danger" v-if="errors.date">{{ errors.date[0] }}</small>
			                  
			                
			               </div>
			             
			             </div>
			           </div>
		        	   <button type="submit" class="btn btn-success">Search</button>
	              </form>
	          	  </div>

	          	  <div class="col-md-6">
	          	  	<form @submit.prevent="searchOrderMonth">
		                <div class="form-group">
			              <div class="form-row">
			               <div class="col-md-12">
			                <div class="form-label-group">
			                  <select class="form-control" v-model="form.month">
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
			                  	 <option value="December">December</option>
			                  
			                  </select>
			                </div>
			               </div>
			             
			             </div>
			           </div>
		        	   <button type="submit" class="btn btn-success">Search</button>
	              </form>
	          	  </div>
			  	
			  </div>
          
          </div>
         
       </div>
   </div>
   <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Order  
           
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
                      <th>Qty</th>
                      <th>Total Amount</th>
                      <th>Pay</th>
                      <th>Due</th>
                      <th>PayBy</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                
                  <tbody>

                    <tr v-for="order in orders" :key="order.id">
                      <td>{{ order.customer.name }}</td>
                      <td>{{ order.qty }}</td>
                      <td>{{ order.total }}</td>
                      <td>{{ order.pay }}</td>
                      <td>{{ order.due }}</td>
                      <td>{{ order.payby }}</td>
                     
                      <td>
                        <router-link :to="{name: 'view-order', params: {id: order.id}}" class="btn btn-sm btn-info">View</router-link>
                        
                      </td>
                    </tr> 
        
                  </tbody>
                  <tfoot>
                  	<td></td>
                  	<td>{{ quantity }}</td>
                  	<td>{{ total }} Tk</td>
                  	<td>{{ pay }} Tk</td>
                  	<td>{{ due }} Tk</td>
                  	<td></td>
                  	<td></td>
                  </tfoot>
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
				this.$router.push({name:'/'})
			}
		},
		data(){
			return {
				form: {
					month: '',
				},
				date: '',
				orders: [],
				searchTerm: '',
				errors: {},
			}
		},

		computed: {
			quantity(){
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++){
					sum += parseFloat(this.orders[i].qty)
				}
				return sum
			},

			total(){
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++){
					sum += parseFloat(this.orders[i].total)
				}
				return sum
			},

			pay(){
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++){
					sum += parseFloat(this.orders[i].pay)
				}
				return sum
			},

			due(){
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++){
					sum += parseFloat(this.orders[i].due)
				}
				return sum
			},

		},

		methods: {
			searchOrder(){
				let data = {
					date: this.date
				}
				axios.post('/api/search/date',data)
				.then(({data}) => {
					this.orders = data
					
				})
				.catch(error => this.errors = error.response.data.errors)
			},

			searchOrderMonth(){
				axios.post('/api/search/month',this.form)
				.then(({data}) => {
					this.orders = data
				})
				.catch(error => this.errors = error.response.data.errors)
			}
		
		}

	}
  
</script>

<style>
	
#add_new{
	float: right;
}
</style>