<template>
    <div id="user-modal" class="modal fade bd-example-modal-lg"
         tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog mt-0 modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="selectedUrl" class="modal-title">Edit Employee</h5>
                    <h5 v-else class="modal-title">Add Employee</h5>
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
                                <label class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input v-on:change="selectImage"
                                           type="file"
                                           placeholder="Photo">
                                    <p
                                        v-if="errors.image"
                                        class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                        style="padding-left: 0px;
                                        font-size: 14px;
                                        margin-top: 3px;"
                                    >
                                        {{ errors.image[0] }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="control-group">
                                            <div class="radio">
                                                <label>
                                                    <input name="form-field-radio" v-model="form.gender" type="radio" class="ace" value="male" />
                                                    <span class="lbl"> Male</span>
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input name="form-field-radio" v-model="form.gender" type="radio" class="ace" value="female" />
                                                    <span class="lbl"> Female</span>
                                                </label>
                                            </div>
                                            <p
                                                v-if="errors.gender"
                                                class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                                style="padding-left: 0px;
                                                font-size: 14px;
                                                margin-top: 3px;"
                                            >
                                                {{ errors.gender[0] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Skills</label>
                                <div class="col-sm-9">
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="control-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input name="form-field-checkbox" v-model="form.skills" value="Laravel" type="checkbox" class="ace" />
                                                    <span class="lbl"> Laravel</span>
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input name="form-field-checkbox" v-model="form.skills" value="Condeigniter" type="checkbox" class="ace" />
                                                    <span class="lbl"> Condeigniter</span>
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input name="form-field-checkbox" v-model="form.skills" value="Ajax" class="ace ace-checkbox-2" type="checkbox" />
                                                    <span class="lbl"> Ajax</span>
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label class="block">
                                                    <input name="form-field-checkbox" v-model="form.skills" value="VUE JS" type="checkbox" class="ace" />
                                                    <span class="lbl"> VUE JS</span>
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label class="block">
                                                    <input name="form-field-checkbox" v-model="form.skills" value="MySQL" type="checkbox" class="ace input-lg" />
                                                    <span class="lbl bigger-120"> MySQL</span>
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label class="block">
                                                    <input name="form-field-checkbox" v-model="form.skills" value="API" type="checkbox" class="ace input-lg" />
                                                    <span class="lbl bigger-120"> API</span>
                                                </label>
                                            </div>

                                            <p
                                                v-if="errors.skills"
                                                class="text-danger col-sm-12 mt-2 mb-0 float-right"
                                                style="padding-left: 0px;
                                                font-size: 14px;
                                                margin-top: 3px;"
                                            >
                                                {{ errors.skills[0] }}
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
                    <button style="font-size: 16px;" type="button" class="btn btn-secondary" @click.prevent="closeModal">
                        Cancel
                    </button>
                    <button v-if="selectedUrl" style="font-size: 16px;" type="submit" class="btn btn-primary" @click.prevent="update">
                        Update
                    </button>
                    <button style="font-size: 16px;" v-else type="submit" class="btn btn-primary" @click.prevent="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserAddEditModal",
    props:['selectedUrl'],
    data(){
        return{
            form: new Form({
                name: '',
                email: '',
                gender: '',
                skills: [

                ]
            }),
            errors:{}
        }
    },
    methods:{
        closeModal(){
            this.$emit("close-modal");
        },
        submit(){
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('email', this.form.email);
            formData.append('image', this.form.image);
            formData.append('gender', this.form.gender);
            formData.append('skills', this.form.skills);

            this.axios.post('/employee', formData)
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
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('email', this.form.email);
            formData.append('image', this.form.image);
            formData.append('gender', this.form.gender);
            formData.append('skills', this.form.skills);

            this.axios.post('/employee-update/'+ this.form.id, formData)
                .then((response) => {
                    if (response.status == 200){
                        this.$toast.success(response.data.message);
                        this.closeModal();
                    }
                }).catch((error)=>{
                this.errors = error.response.data.errors;
            });
        },
        selectImage(file) {
            if (file == "") return false;
            this.form.image = file.target.files[0];
        },
        getEditedData(){
            this.axios.get(this.selectedUrl)
                .then((response) => {
                    this.form = response.data;
                    this.form.skills = response.data.skills.split(",");
                }).catch((error) => {

            });
        }
    },
    created() {
        if (this.selectedUrl){
            this.getEditedData();
        }
    }
}
</script>

<style scoped>

</style>
