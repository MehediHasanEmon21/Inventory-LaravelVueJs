

let login = require('./components/auth/login.vue').default
let register = require('./components/auth/register.vue').default
let forget = require('./components/auth/forget.vue').default
let logout = require('./components/auth/logout.vue').default

let home = require('./components/home.vue').default

//employee component
let all_employee = require('./components/employee/index.vue').default
let add_employee = require('./components/employee/create.vue').default
let edit_employee = require('./components/employee/edit.vue').default

//supplier component
let all_supplier = require('./components/supplier/index.vue').default
let add_supplier = require('./components/supplier/create.vue').default
let edit_supplier = require('./components/supplier/edit.vue').default

//supplier component
let all_category = require('./components/category/index.vue').default
let add_category = require('./components/category/create.vue').default
let edit_category = require('./components/category/edit.vue').default

//supplier component
let all_product = require('./components/product/index.vue').default
let add_product = require('./components/product/create.vue').default
let edit_product = require('./components/product/edit.vue').default

//supplier component
let all_expense = require('./components/expense/index.vue').default
let add_expense = require('./components/expense/create.vue').default
let edit_expense = require('./components/expense/edit.vue').default

//customer component
let all_customer = require('./components/customer/index.vue').default
let add_customer = require('./components/customer/create.vue').default
let edit_customer = require('./components/customer/edit.vue').default

//supplier component
let employee = require('./components/salary/all_employee.vue').default
let add_salary = require('./components/salary/create.vue').default
let all_salary = require('./components/salary/index.vue').default
let view_salary = require('./components/salary/view_salary.vue').default
let edit_salary = require('./components/salary/edit_salary.vue').default

//stock component
let stock = require('./components/product/stock.vue').default
let edit_stock = require('./components/product/edit_stock.vue').default

//pos component
let pos = require('./components/pos/pointofsale.vue').default

//order component
let order = require('./components/order/order.vue').default
let view_order = require('./components/order/view_order.vue').default
let all_order = require('./components/order/all_order.vue').default

//search component
let search_order = require('./components/search/search_order.vue').default



export const routes = [
  { path: '/', component: login, name: '/' },
  { path: '/register', component: register, name: 'register' },
  { path: '/forget', component: forget, name: 'forget' },
  { path: '/logout', component: logout, name: 'logout' },

  { path: '/home', component: home, name: 'home' },

  //employee route
  { path: '/all-employee', component: all_employee, name: 'all-employee' },
  { path: '/add-employee', component: add_employee, name: 'add-employee' },
  { path: '/edit-employee/:id', component: edit_employee, name: 'edit-employee' },

   //supplier route
  { path: '/all-supplier', component: all_supplier, name: 'all-supplier' },
  { path: '/add-supplier', component: add_supplier, name: 'add-supplier' },
  { path: '/edit-supplier/:id', component: edit_supplier, name: 'edit-supplier' },

  //customer route
  { path: '/all-customer', component: all_customer, name: 'all-customer' },
  { path: '/add-customer', component: add_customer, name: 'add-customer' },
  { path: '/edit-customer/:id', component: edit_customer, name: 'edit-customer' },

  //category route
  { path: '/all-category', component: all_category, name: 'all-category' },
  { path: '/add-category', component: add_category, name: 'add-category' },
  { path: '/edit-category/:id', component: edit_category, name: 'edit-category' },


  //product route
  { path: '/all-product', component: all_product, name: 'all-product' },
  { path: '/add-product', component: add_product, name: 'add-product' },
  { path: '/edit-product/:id', component: edit_product, name: 'edit-product' },

  //product route
  { path: '/all-expense', component: all_expense, name: 'all-expense' },
  { path: '/add-expense', component: add_expense, name: 'add-expense' },
  { path: '/edit-expense/:id', component: edit_expense, name: 'edit-expense' },

  //salary route
  { path: '/pay', component: employee, name: 'pay' },
  { path: '/pay-salary/:id', component: add_salary, name: 'pay-salary' },
  { path: '/all-salary', component: all_salary, name: 'all-salary' },
  { path: '/view-salary/:month', component: view_salary, name: 'view-salary' },
  { path: '/edit-salary/:id', component: edit_salary, name: 'edit-salary' },

  //stock route
  { path: '/stock', component: stock, name: 'stock' },
  { path: '/edit-stock/:id', component: edit_stock, name: 'edit-stock' },

  //pos route
  { path: '/pos', component: pos, name: 'pos' },

  //order route
  { path: '/order', component: order, name: 'order' },
  { path: '/view-order/:id', component: view_order, name: 'view-order' },
  { path: '/all-order', component: all_order, name: 'all-order' },


  //search route
  { path: '/search-order', component: search_order, name: 'search-order' },

]