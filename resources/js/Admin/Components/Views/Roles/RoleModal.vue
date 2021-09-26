<template>
    <div id="role-modal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit role</h5>
                    <h5 v-else class="modal-title">Add role</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Role name</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           v-model="form.name"
                                           class="form-control"
                                           placeholder="Enter name">
                                    <p
                                        v-if="errors.name"
                                        class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                        style="padding-left: 0px;
                                        font-size: 14px;
                                        margin-top: 3px;"
                                    >
                                        {{ errors.name[0] }}
                                    </p>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Permissions</label>
                                <div class="col-sm-9">
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="control-group">
                                            <div class="checkbox" v-for="permission in permissions">
                                                <label>
                                                    <input name="form-field-checkbox" v-model="form.permissions" :value="permission.id" type="checkbox" class="ace" />
                                                    <span class="lbl"> {{ permission.name }}</span>
                                                </label>
                                            </div>
                                            <p
                                                v-if="errors.roles"
                                                class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                                style="padding-left: 0px;
                                                font-size: 14px;
                                                margin-top: 3px;"
                                            >
                                                {{ errors.roles[0] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary submit-button" @click.prevent="closeModal">
                        Cancel
                    </button>
                    <button v-if="selectedUrl" type="submit" class="btn btn-primary submit-button" @click.prevent="update">
                        Update
                    </button>
                    <button v-else type="submit" class="btn btn-primary submit-button" @click.prevent="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "RoleModal",
    props:['selectedUrl'],
    data(){
        return{
            form: new Form({
                name: '',
                guard_name: 'sanctum',
                permissions: []
            }),
            permissions: [],
            errors: {},
        }
    },
    methods:{
        closeModal(){
            this.$emit("close-modal");
        },
        submit(){
            this.axios.post('/roles', this.form)
                .then((response) => {
                    if (response.status == 200){
                        this.$toast.success(response.data.message);
                        this.closeModal();
                    }
                }).catch((error)=>{
                this.errors = error.response.data.errors;
            });
        },
        update(){
            this.axios.patch(this.selectedUrl, this.form)
                .then((response) => {
                    if (response.status == 200){
                        this.$toast.success(response.data.message);
                        this.closeModal();
                    }
                }).catch((error)=>{
                this.errors = error.response.data.errors;
            });
        },
        getEditedData(){
            this.axios.get(this.selectedUrl)
                .then((response) => {
                    this.form = response.data;
                }).catch((error) => {

            });
        },
        getRolePermissions(){
            this.axios.get('/all-permissions')
                .then((response) => {
                    this.permissions = response.data;
                }).catch((error) => {

            });
        }
    },
    created() {
        this.getRolePermissions();
        if (this.selectedUrl){
            this.getEditedData();
        }
    }
}
</script>

