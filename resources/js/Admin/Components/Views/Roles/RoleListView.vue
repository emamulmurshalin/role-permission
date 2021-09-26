<template>
    <div class="page-content" style="margin: 20px !important;">
        <div class="row">
            <div class="col-xs-12" style="width: 100%;">
                <h3 class="header smaller lighter blue font-color">Role list view</h3>

                <div class="clearfix" style="margin-bottom: 14px;">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <button v-if="$can('role_create')" @click.prevent="openModal" data-toggle="modal" class="btn btn-primary btn-design">
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
                            <th class="font-color">Role</th>
                            <th v-if="$can('role_update') || $can('role_delete')" class="font-color">
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Action
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="role in roleData">
                            <td>
                                <a href="#">{{ role.id }}</a>
                            </td>
                            <td>{{ role.name }}</td>
                            <td v-if="$can('role_update') || $can('role_delete')">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a v-if="$can('role_update')" @click="editRole(role.id)" class="dropdown-item" href="#"><i
                                            class="fas fa-cogs text-dark-pastel-green edit-button"></i>Edit</a>
                                        <a v-if="$can('role_delete')" @click.prevent="deleteRole(role.id)" class="dropdown-item" href="#"><i
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
                :click-handler="getRoles"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'"
                :page-class="'page-item'">
            </paginate>
        </div>

        <role-add-edit-modal v-if="isModalActive"
                             :selected-url="selectedUrl"
                             @close-modal="closeModal">
        </role-add-edit-modal>
        <app-confirmation-modal v-if="isConfirmationModal"
                                :is-active="isConfirmationModal"
                                @confirm="confirmed"
                                @cancel="cancelled">
        </app-confirmation-modal>
    </div>
</template>

<script>
export default {
    name: "RoleListView",
    data(){
        return {
            isModalActive: false,
            isConfirmationModal: false,
            selectedUrl: '',
            deletedId: null,
            roleData: {},
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
        deleteRole(id){
            this.deletedId = id;
            this.isConfirmationModal = true;
        },
        editRole(id){
            this.selectedUrl = `/roles/${id}`;
            this.isModalActive = true;
            setTimeout(()=> {
                $('#role-modal').modal('show');
            })
        },
        openModal(){
            this.isModalActive = true;
            setTimeout(()=> {
                $('#role-modal').modal('show');
            })
        },
        closeModal(){
            this.selectedUrl = "";
            this.isModalActive = false;
            $('#role-modal').modal('hide');
            this.getRoles();
        },
        confirmed(){
            this.axios.delete(`/roles/${this.deletedId}`)
                .then((response) => {
                    if(response.status == 200){
                        this.$toast.success(response.data.message);
                        this.isConfirmationModal = false;
                        this.getRoles();
                    }
                }).catch(()=>{
                this.isConfirmationModal = false;
            });
        },
        cancelled(){
            this.isConfirmationModal = false;
            this.deletedId = null;
        },
        getRoles(){
            this.axios.get('/roles')
                .then((res) => {
                    this.totalData = res.data.total;
                    this.roleData = res.data.data;
                }).catch(()=>{
            });
        }
    },
    mounted() {
        this.getRoles();
    },
};
</script>

<style scoped>
.edit-button{
    margin-right: 25px;
}
</style>
