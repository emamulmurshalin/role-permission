<template>
    <div class="page-content" style="margin: 20px !important;">
        <div class="row">
            <div class="col-xs-12" style="width: 100%;">
                <h3 class="header smaller lighter blue font-color">Employee list view</h3>

                <div class="clearfix" style="margin-bottom: 14px;">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <button v-if="$can('employee_create')" @click.prevent="openModal"
                        data-toggle="modal" class="btn btn-primary btn-design">
                    <i class="fas glyphicon-plus"></i>
                    Add new
                </button>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="font-color">ID</th>
                            <th class="font-color">Name</th>
                            <th class="font-color">Email</th>
                            <th class="font-color">Gender</th>
                            <th class="font-color">Skills</th>
                            <th class="font-color">Image</th>
                            <th class="font-color"
                                v-if="$can('employee_update') || $can('employee_delete')">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Action
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="employee in employeeData">
                            <td>
                                <a href="#">{{ employee.id }}</a>
                            </td>
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.email }}</td>
                            <td>{{ employee.gender }}</td>
                            <td>{{ employee.skills }}</td>
                            <td>
                                <img style="height: 37px; width: 40px;" class="pdf-icon"
                                     :src="'/storage/' + employee.image_path">
                            </td>
                            <td v-if="$can('employee_update') || $can('employee_delete')">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu action-dropdown">
                                        <a v-if="$can('employee_update')" @click="editEmployee(employee.id)" class="dropdown-item" href="#"><i
                                            class="fas fa-cogs text-dark-pastel-green action-button"></i>Edit</a>
                                        <a v-if="$can('employee_delete')" @click.prevent="deleteEmployee(employee.id)" class="dropdown-item" href="#"><i
                                            class="fas fa-trash text-orange-red action-button"></i>Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div style="float: right;">
            <paginate
                :page-count="pageCount"
                :click-handler="getEmployees"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'"
                :page-class="'page-item'">
            </paginate>
        </div>

        <employee-add-edit-modal v-if="isModalActive"
                                 :selected-url="selectedUrl"
                                 @close-modal="closeModal">
        </employee-add-edit-modal>
        <app-confirmation-modal v-if="isConfirmationModal"
                                :is-active="isConfirmationModal"
                                @confirm="confirmed"
                                @cancel="cancelled">
        </app-confirmation-modal>
    </div>
</template>

<script>
export default {
    name: 'EmployeeListView',
    data(){
        return {
            isModalActive: false,
            isConfirmationModal: false,
            selectedUrl: '',
            deletedId: null,
            employeeData: {},
            perPage: 10,
            totalData: 0,
        };
    },
    computed:{
        pageCount(){
            if (this.totalData <= 10){
                return 1;
            }else {
                let totalPage;
                totalPage = (this.totalData % this.perPage);
                if (totalPage == 0){
                    totalPage = (this.totalData / this.perPage) + 1;
                }else {
                    totalPage = (this.totalData / this.perPage);
                }
                return totalPage;
            }
        }
    },
    methods:{
        deleteEmployee(id){
            this.deletedId = id;
            this.isConfirmationModal = true;
        },
        editEmployee(id){
            this.selectedUrl = `/employee/${id}`;
            this.isModalActive = true;
            setTimeout(()=> {
                $('#employee-modal').modal('show');
            })
        },
        openModal(){
            this.isModalActive = true;
            setTimeout(()=> {
                $('#employee-modal').modal('show');
            })
        },
        closeModal(){
            this.selectedUrl = "";
            this.isModalActive = false;
            $('#employee-modal').modal('hide');
            this.getEmployees();
        },
        confirmed(){
            this.axios.delete(`/employee/${this.deletedId}`)
                .then((response) => {
                    if(response.status == 200){
                        this.$toast.success(response.data.message);
                        this.isConfirmationModal = false;
                        this.getEmployees();
                    }
                }).catch(()=>{
                this.isConfirmationModal = false;
            });
        },
        cancelled(){
            this.isConfirmationModal = false;
            this.deletedId = null;
        },
        getEmployees(){
            this.axios.get('/employee')
                .then((response) => {
                    this.totalData = response.data.total;
                    this.employeeData = response.data.data;
                }).catch(()=>{
            });
        }
    },
    mounted() {
        this.getEmployees();
    },
};
</script>
