<template>
    <div v-if="dataLoaded">
        <div class="row" style="margin-left: 0px;">
            <div class="col-xl-10 col-sm-10 col-md-10" style="float: left; padding-left: 0px;">
                <h3 class="header smaller lighter blue">Trash Employee List View</h3>
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-2 col-md-2" style="float: right">
                <button style="float: right; font-size: 16px;" @click.prevent="openModal" data-toggle="modal" class="btn btn-success">
                    Add new
                </button>
            </div>

        </div>

        <vue-good-table
            :columns="columns"
            :rows="employeeData"
            :pagination-options="pagination"
            :search-options="searchOption"
            :sort-options="sortOption"
            @on-search="onSearch"
            @on-page-change="onPageChange"
            @on-per-page-change="onPageChange"
            @on-sort-change="onSortChange"
            @on-column-filter="onColumnFilter"
            :totalRows="totalData">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'action'">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                           aria-expanded="false">
                            <span class="flaticon-more-button-of-three-dots"></span>
                        </a>
                        <div class="dropdown-menu">
                              <a class="dropdown-item" href="#" @click.prevent="getAction(props.row, 'edit')">
                                  <i class="fas fa-cogs text-dark-pastel-green edit-button"></i>
                                  Edit
                              </a>
                              <a class="dropdown-item" href="#" @click.prevent="getAction(props.row, 'delete')">
                                  <i class="fas fa-trash text-orange-red edit-button"></i>
                                  Delete
                              </a>
                        </div>
                    </div>
                </span>
                <span v-else>
                  {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>
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
    name: 'UsaUserListView',
    data(){
        return {
            isModalActive: false,
            isConfirmationModal: false,
            addTrialTimeModal: false,
            selectedUrl: '',
            deletedId: null,
            employeeData: {},
            totalData: '',
            dataLoaded: true,
            columns: [
                {
                    label: 'Name',
                    field: 'name',
                },
                {
                    label: 'Email',
                    field: 'email',
                    type: 'number',
                    sortable: false
                },
                {
                    label: 'Image',
                    field: 'image_path',
                    type: 'file',
                    sortable: false
                },
                {
                    label: 'Gender',
                    field: 'gender',
                },
                {
                    label: 'Skills',
                    field: 'skills',
                },
                {
                    label: 'Action',
                    field: 'action',
                    sortable: false,
                },
            ],
            searchOption: {
                enabled: true,
                trigger: 'enter',
                skipDiacritics: true,
                placeholder: 'Search this table'
            },
            pagination: {
                enabled: true,
                mode: 'records',
                perPage: 10,
                position: 'bottom',
                perPageDropdown: [5, 10, 15],
                dropdownAllowAll: false,
                setCurrentPage: 1,
                nextLabel: 'next',
                prevLabel: 'prev',
                rowsPerPageLabel: 'Rows per page',
                ofLabel: 'of',
                pageLabel: 'page', // for 'pages' mode
                allLabel: 'All',
                infoFn: (params) => `my own page ${params.firstRecordOnPage}`,
            },
            sortOption: {
                enabled: true,
                initialSortBy:
                    { field: 'name', type: 'asc' }
            },
        };
    },
    methods:{
        getAction(rowData, actionType){
            //console.log(rowData, actionType, 'row data');
            if (actionType == 'delete'){
                this.deletedId = rowData.id;
                this.isConfirmationModal = true;
            }else if(actionType == 'edit'){
                this.selectedUrl = `employee/${rowData.id}`;
                this.isModalActive = true;
                setTimeout(()=> {
                    $('#user-modal').modal('show');
                })
            }
        },
        onSearch(search){
            // console.log(search, 'search data');
        },
        onPageChange(page){
            // console.log(page, 'page change');
        },
        onSortChange(sort){
            // console.log(sort, 'sort column');
        },
        onColumnFilter(filter){
            console.log(filter, 'filter data');
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
        closeModalTrialModal(){
            this.selectedUrl = "";
            this.addTrialTimeModal = false;
            $('#trial-time-modal').modal('hide');
        },
        confirmed(){
            this.axios.delete(`employee/${this.deletedId}`)
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
            this.axios.get('/trash-employee')
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

<style scoped>
.dropdown-toggle::after{
    display: none !important;
}
</style>
