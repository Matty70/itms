<script >
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors
    },

    props: {
        employees: Array,
        branches: Array
    },
      created (){

    },
    data() {
        return {
               form: useForm({
                   name: '',
                   email: '',
                   gender: '',
                   age: '',
                   branch: '',
                   phone:''


 }),
          }
    },

    methods: {
          submit () {
   this.form.post(route('create.employee'), {
        onFinish: () =>  this.$nextTick(() => {
      this.$bvModal.hide('addEmployeeModal')
    }),
    });
},
      }
  }


</script>

<template>
    <Head title="Industry Temperature Management System" />

    <BreezeAuthenticatedLayout>

      <div class="table-wrapper">
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-6">
                      <h2><b>Employees</b></h2>
                  </div>
                  <div class="col-sm-6">
                      <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                              class="material-icons">&#xE147;</i> <span>New Employee</span></a>

                  </div>
              </div>
          </div>
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <th>
                          <span class="custom-checkbox">
                              <input type="checkbox" id="selectAll">
                              <label for="selectAll"></label>
                          </span>
                      </th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Age</th>
                      <th>Branch</th>
                      <th>Phone</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="employee in employees">
                      <td>
                          <span class="custom-checkbox">
                              <input type="checkbox" id="checkbox1" name="options[]" value="1">
                              <label for="checkbox1"></label>
                          </span>
                      </td>
                      <td>{{employee.name}}</td>
                      <td>{{employee.email}}</td>
                      <td>{{employee.gender}}</td>
                      <td>{{employee.age}}</td>
                      <td> {{employee.branch}}</td>
                      <td>{{employee.phone}}</td>
                      <td>
                          <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                                  data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                          <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                                  data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                      </td>
                  </tr>

              </tbody>
          </table>
          </div>
          <div class="clearfix">
              <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
              <ul class="pagination">
                  <li class="page-item disabled"><a href="#">Previous</a></li>
                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item active"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">4</a></li>
                  <li class="page-item"><a href="#" class="page-link">5</a></li>
                  <li class="page-item"><a href="#" class="page-link">Next</a></li>
              </ul>
          </div>
                 <!-- Add Modal HTML -->
  <div id="addEmployeeModal" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
          <BreezeValidationErrors class="mb-4" />
              <form @submit.prevent="submit">
                  <div class="modal-header">
                      <h4 class="modal-title">Add Employee</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" required v-model="form.name">
                      </div>
                      <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" required v-model="form.email">
                      </div>
                      <div class="form-group">
                          <label>Gender</label>
                          <input type="text" class="form-control" required v-model="form.gender">
                      </div>
                      <div class="form-group">
                          <label>Age</label>
                          <input type="number" class="form-control" required v-model="form.age">
                      </div>
                      <div class="form-group">
                          <label>Branch</label>
                         <select class="form-select form-select-lg mb-3" v-model="form.branch">
                             <option v-for="branch in branches" >{{branch.name}}</option>

                         </select>
                      </div>
                      <div class="form-group">
                          <label>Phone</label>
                          <input type="text" class="form-control" required v-model="form.phone">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                       <input type="submit" class="btn btn-success" value="Add" @click="submit" data-dismiss="modal" >
                  </div>
              </form>
          </div>
      </div>
  </div>
  <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <form>
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Employee</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                   <div class="modal-body">
                       <div class="form-group">
                           <label>Name</label>
                           <input type="text" class="form-control" required>
                       </div>
                       <div class="form-group">
                           <label>Email</label>
                           <input type="email" class="form-control" required>
                       </div>
                       <div class="form-group">
                           <label>Gender</label>
                           <input type="text" class="form-control" required>
                       </div>
                       <div class="form-group">
                           <label>Age</label>
                           <input type="number" class="form-control" required>
                       </div>
                       <div class="form-group">
                           <label>Branch</label>
                           <select class="form-select form-select-lg mb-3">
                               <option selected>Select Branch</option>
                               <option value="1">Branch A</option>
                               <option value="2">Branch B</option>
                               <option value="3">Branch c</option>
                           </select>


                       </div>
                       <div class="form-group">
                           <label>Phone</label>
                           <input type="text" class="form-control" required>
                       </div>
                   </div>
                  <div class="modal-footer">
                      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                      <input type="submit" class="btn btn-info" value="Save">
                  </div>
              </form>
          </div>
      </div>
  </div>
  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <form>
                  <div class="modal-header">
                      <h4 class="modal-title">Delete Employee</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                      <p>Are you sure you want to delete these Records?</p>
                      <p class="text-warning"><small>This action cannot be undone.</small></p>
                  </div>
                  <div class="modal-footer">
                      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                      <input type="submit" class="btn btn-danger" value="Delete">
                  </div>
              </form>
          </div>
      </div>
  </div>
    </BreezeAuthenticatedLayout>
</template>
<style>
  body  {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
    }
    .table-wrapper {
    background: #fff;
    padding: 20px 25px;
    margin: 30px 0;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
    padding-bottom: 15px;
    background: #3c62d1;
    color: #fff;
    padding: 16px 30px;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
    }
    .table-title .btn-group {
    float: right;
    }
    .table-title .btn {
    color: #fff;
    float: right;
    font-size: 13px;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
    }
    .table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
    }
    .table-title .btn span {
    float: left;
    margin-top: 2px;
    }
    table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
    }
    table.table tr th:first-child {
    width: 60px;
    }
    table.table tr th:last-child {
    width: 100px;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
    }
    table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
    }
    table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
    }
    table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
    }
    table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
    outline: none !important;
    }
    table.table td a:hover {
    color: #2196F3;
    }
    table.table td a.edit {
    color: #FFC107;
    }
    table.table td a.delete {
    color: #F44336;
    }
    table.table td i {
    font-size: 19px;
    }
    table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
    }
    .pagination {
    float: right;
    margin: 0 0 5px;
    }
    .pagination li a {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 2px !important;
    text-align: center;
    padding: 0 6px;
    }
    .pagination li a:hover {
    color: #666;
    }
    .pagination li.active a, .pagination li.active a.page-link {
    background: #03A9F4;
    }
    .pagination li.active a:hover {
    background: #0397d6;
    }
    .pagination li.disabled i {
    color: #ccc;
    }
    .pagination li i {
    font-size: 16px;
    padding-top: 6px
    }
    .hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
    }
    /* Custom checkbox */
    .custom-checkbox {
    position: relative;
    }
    .custom-checkbox input[type="checkbox"] {
    opacity: 0;
    position: absolute;
    margin: 5px 0 0 3px;
    z-index: 9;
    }
    .custom-checkbox label:before{
    width: 18px;
    height: 18px;
    }
    .custom-checkbox label:before {
    content: '';
    margin-right: 10px;
    display: inline-block;
    vertical-align: text-top;
    background: white;
    border: 1px solid #bbb;
    border-radius: 2px;
    box-sizing: border-box;
    z-index: 2;
    }
    .custom-checkbox input[type="checkbox"]:checked + label:after {
    content: '';
    position: absolute;
    left: 6px;
    top: 3px;
    width: 6px;
    height: 11px;
    border: solid #000;
    border-width: 0 3px 3px 0;
    transform: inherit;
    z-index: 3;
    transform: rotateZ(45deg);
    }
    .custom-checkbox input[type="checkbox"]:checked + label:before {
    border-color: #03A9F4;
    background: #03A9F4;
    }
    .custom-checkbox input[type="checkbox"]:checked + label:after {
    border-color: #fff;
    }
    .custom-checkbox input[type="checkbox"]:disabled + label:before {
    color: #b8b8b8;
    cursor: auto;
    box-shadow: none;
    background: #ddd;
    }
    /* Modal styles */
    .modal .modal-dialog {
    max-width: 400px;
    }
    .modal .modal-header, .modal .modal-body, .modal .modal-footer {
    padding: 20px 30px;
    }
    .modal .modal-content {
    border-radius: 3px;
    }
    .modal .modal-footer {
    background: #ecf0f1;
    border-radius: 0 0 3px 3px;
    }
    .modal .modal-title {
    display: inline-block;
    }
    .modal .form-control {
    border-radius: 2px;
    box-shadow: none;
    border-color: #dddddd;
    }
    .modal textarea.form-control {
    resize: vertical;
    }
    .modal .btn {
    border-radius: 2px;
    min-width: 100px;
    }
    .modal form label {
    font-weight: normal;
    }
</style>
