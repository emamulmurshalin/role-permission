<template>
    <div class="page-content" style="margin: 20px !important;">
        <div class="row">
            <div class="col-xs-12" style="width: 100%;">
                <h3 class="header smaller lighter blue font-color">User list view</h3>

                <div class="clearfix" style="margin-bottom: 14px;">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <button style="float: right; margin-bottom: 15px; padding: 8px; font-size: 16px;"
                        @click.prevent="openModal" data-toggle="modal" class="btn btn-primary">
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
                            <th class="font-color">Role</th>
                            <th class="font-color">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Action
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="user in userData">
                            <td>
                                <a href="#">{{ user.id }}</a>
                            </td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td></td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a @click="editUser(user.id)" class="dropdown-item" href="#"><i
                                            class="fas fa-cogs text-dark-pastel-green edit-button"></i>Edit</a>
                                        <a @click.prevent="deleteUser(user.id)" class="dropdown-item" href="#"><i
                                            class="fas fa-trash text-orange-red edit-button"></i>Delete</a>
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
                :click-handler="getUser"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'"
                :page-class="'page-item'">
            </paginate>
        </div>

        <user-add-edit-modal v-if="isModalActive"
                                 :selected-url="selectedUrl"
                                 @close-modal="closeModal">
        </user-add-edit-modal>
        <app-confirmation-modal v-if="isConfirmationModal"
                                :is-active="isConfirmationModal"
                                @confirm="confirmed"
                                @cancel="cancelled">
        </app-confirmation-modal>
    </div>
</template>

<script>
export default {
    name: "UserListView",
    data(){
        return {
            isModalActive: false,
            isConfirmationModal: false,
            selectedUrl: '',
            deletedId: null,
            userData: {},
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
        deleteUser(id){
            this.deletedId = id;
            this.isConfirmationModal = true;
        },
        editUser(id){
            this.selectedUrl = `/users/${id}`;
            this.isModalActive = true;
            setTimeout(()=> {
                $('#user-modal').modal('show');
            })
        },
        openModal(){
            this.isModalActive = true;
            setTimeout(()=> {
                $('#user-modal').modal('show');
            })
        },
        closeModal(){
            this.selectedUrl = "";
            this.isModalActive = false;
            $('#user-modal').modal('hide');
            this.getEmployees();
        },
        confirmed(){
            this.axios.delete(`users/${this.deletedId}`)
                .then((response) => {
                    if(response.status == 200){
                        this.$toast.success(response.data.message);
                        this.isConfirmationModal = false;
                        this.getUser();
                    }
                }).catch(()=>{
                this.isConfirmationModal = false;
            });
        },
        cancelled(){
            this.isConfirmationModal = false;
            this.deletedId = null;
        },
        getUser(){
            this.axios.get('/employee')
                .then((response) => {
                    this.totalData = response.data.total;
                    this.userData = response.data.data;
                }).catch(()=>{
            });
        }
    },
    mounted() {
        this.getUser();
    },
};
</script>

<style scoped>
.edit-button{
    margin-right: 25px;
}
</style>
