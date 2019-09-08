 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">All Order Details</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Order
            
          </div>
          <div class="card-body">

          	<div class="row">
          		<div class="col-md-6">
          			<ul class="list-group">
					  <li class="list-group-item"><strong>Name : </strong>{{ order.customer.name}}</li>
					  <li class="list-group-item"><strong>Phone : </strong>{{ order.customer.phone}}</li>
					  <li class="list-group-item"><strong>Address : </strong>{{ order.customer.address}}</li>
					  <li class="list-group-item"><strong>Date : </strong>{{ order.order_date}}</li>
					  <li class="list-group-item"><strong>Quantity : </strong>{{ order.qty}}</li>
					</ul>
          		</div>

          		<div class="col-md-6">
          			<ul class="list-group">
					  <li class="list-group-item"><strong>Sub Total : </strong>{{ order.sub_total}}</li>
					  <li class="list-group-item"><strong>Vat : </strong>{{ order.vat}} %</li>
					  <li class="list-group-item"><strong>Total : </strong>{{ order.total}}</li>
					  <li class="list-group-item"><strong>Pay : </strong>{{ order.pay}}</li>
					  <li class="list-group-item"><strong>Due : </strong>{{ order.due}}</li>
					
					</ul>
          		</div>
          		

          	</div>

          </div>
       </div>
       <div class="row card container">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Order Details
            
          </div>
          <div class="card-body">

          	<div class="table-responsive">
                <label>Search</label>
               <input type="text" v-model="searchTerm" class="form-control" style="width:200px; "><br>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Image</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                
                  <tbody>

                    <tr v-for="detail in filterDetails" :key="detail.id">
                      <td>{{ detail.product.product_name }}</td>
                      <td>{{ detail.product.product_code }}</td>
                      <td><img :src="'/'+detail.product.image" id="em_photo"></td>
                      <td>{{ detail.pro_quantity }}</td>
                      <td>{{ detail.pro_price }}</td>
                      <td>{{ detail.sub_total }}</td>
                     
                      <td>
                        
                      </td>
                    </tr> 
        
                  </tbody>
                </table>
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
        created(){
        	this.allOrder()
        	this.allOrderDetails()
        },
        data(){
          return{
                order: {},
                details: [],
                searchTerm: '',    
          }
        },
       computed:{
         filterDetails(){
         	return this.details.filter((detail) => {
         		return detail.product.product_name.match(this.searchTerm)
	         })
         }
       },
        methods:{

          allOrder(){
          		let id = this.$route.params.id
        		axios.get('/api/order/'+id)
        		.then(({data}) => this.order = data)
        		.catch()
        	},

           allOrderDetails(){
          		let id = this.$route.params.id
        		axios.get('/api/order/details/'+id)
        		.then(({data}) => this.details = data)
        		.catch()
        	}
         
        },
      
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