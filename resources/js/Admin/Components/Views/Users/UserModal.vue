<template>
    <div id="user-modal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit user</h5>
                    <h5 v-else class="modal-title">Add user</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="quickForm">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
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
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           v-model="form.email"
                                           class="form-control"
                                           placeholder="Enter email">
                                    <p
                                        v-if="errors.email"
                                        class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                        style="padding-left: 0px;
                                        font-size: 14px;
                                        margin-top: 3px;"
                                    >
                                        {{ errors.email[0] }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select v-model="form.role_id" class="form-control">
                                        <option class="disabled">Please Select Role *</option>
                                        <option v-for="(role, index) in roles"
                                                v-bind:value="role.id" :key="index"
                                                :selected="index === 0 ? 'selected' : ''">
                                            {{role.name}}
                                        </option>
                                    </select>
                                    <p
                                        v-if="errors.role_id"
                                        class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                        style="padding-left: 0px;
                                        font-size: 14px;
                                        margin-top: 3px;"
                                    >
                                        {{ errors.role_id[0] }}
                                    </p>
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
    name: "UserModal",
    props:['selectedUrl'],
    data(){
        return{
            form: new Form({
                name: '',
                email: '',
                role_id: ''
            }),
            errors: {},
            roles: {},
        }
    },
    methods:{
        closeModal(){
            this.$emit("close-modal");
        },
        submit(){
            this.axios.post('/users', this.form)
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
                    this.form.role_id = this.form.roles[0].id;
                }).catch((error) => {

            });
        },
        getRoles(){
            this.axios.get('/roles')
                .then((response) => {
                    this.roles = response.data.data;
                }).catch((error) => {

            });
        }
    },
    created() {
        this.getRoles();
        if (this.selectedUrl){
            this.getEditedData();
        }
    }
}
</script>

<style scoped>

</style>

