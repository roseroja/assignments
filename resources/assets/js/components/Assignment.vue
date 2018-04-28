<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">My Assignment</div>

                    <div class="panel-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button @click="initAddAssignment()" class="btn btn-primary btn-xs pull-right">
                            + Add New Assignment
                        </button>
                        My Assignment
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="assignments.length > 0">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Biography</th>
                                    <th>Profile Picture</th>
                                    <th>Action</th>
                                </tr>
                                <tr v-for="(assignments, index) in assignments">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ assignments.name }}</td>
                                    <td>{{ assignments.email }}</td>
                                    <td width="45%">{{ assignments.biography }}</td>
                                    <td><img :src="assignments.profile_picture" id="indeximg" class="img-responsive index-img"></td>
                                    <td>
                                        <p><button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button></p>
                                        <p><button @click="initShow(index)" class="btn btn-info btn-xs">Show</button></p>
                                        <p><button @click="deleteAssignment(index)" class="btn btn-danger btn-xs">Delete</button></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_assignment_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add New Assignments</h4>
                    </div>
                    <div class="modal-body">
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="name">Name:</label>
                            <input type="text" name="Name" id="Name" placeholder="Name" class="form-control"
                                   v-model="assignments.name"  @focus.native="handleFocus">
                            <span v-if="allerros.name" :class="['label label-danger']">@{{ allerros.name[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" placeholder="email" class="form-control"
                                   v-model="assignments.email">
                            <span v-if="allerros.email" :class="['label label-danger']">@{{ allerros.email[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone" placeholder="phone" class="form-control"
                                   v-model="assignments.phone">
                            <span v-if="allerros.phone" :class="['label label-danger']">@{{ allerros.phone[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="Dob">Date Of Birth:</label>
                             <date-picker name="date_of_birth" v-model="assignments.date_of_birth" :config="config"></date-picker>
                             <span v-if="allerros.date_of_birth" :class="['label label-danger']">@{{ allerros.date_of_birth[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="gender">Gender:</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="radio-inline"><input type="radio" name="gender" v-model="assignments.gender" value="Male">Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" v-model="assignments.gender" value="Female">Female</label>
                                </div>
                            </div>
                            <span v-if="allerros.gender" :class="['label label-danger']">@{{ allerros.gender[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="biography">biography:</label>
                            <textarea name="biography" id="biography" cols="30" rows="5" class="form-control"
                                      placeholder="Biography" v-model="assignments.biography"></textarea>
                            <span v-if="allerros.biography" :class="['label label-danger']">@{{ allerros.biography[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="profile_picture">Profile Picture:</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <img :src="profile_picture" class="img-responsive">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" v-on:change="onFileChange"  name="profile_picture" id="profile_picture" placeholder="profile picture"  class="form-control-file">
                                    </div>
                                </div>
                            </div>
                            <span v-if="allerros.profile_picture" :class="['label label-danger']">@{{ allerros.profile_picture[0] }}</span>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createAssignment" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="update_assignment_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Update Assignment</h4>
                    </div>
                    <div class="modal-body">

                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="name">Name:</label>
                            <input type="text" name="Name" id="Name" placeholder="Name" class="form-control"
                                   v-model="update_assignment.name">
                             <span v-if="allerros.name" :class="['label label-danger']">@{{ allerros.name[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" placeholder="email" class="form-control"
                                   v-model="update_assignment.email">
                            <span v-if="allerros.email" :class="['label label-danger']">@{{ allerros.email[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone" placeholder="phone" class="form-control"
                                   v-model="update_assignment.phone">
                            <span v-if="allerros.phone" :class="['label label-danger']">@{{ allerros.phone[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="Dob">Date Of Birth:</label>
                             <date-picker name="date_of_birth" v-model="update_assignment.date_of_birth" :config="config"></date-picker>
                             <span v-if="allerros.date_of_birth" :class="['label label-danger']">@{{ allerros.date_of_birth[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="gender">Gender:</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="radio-inline"><input type="radio" name="gender" v-model="update_assignment.gender" value="Male">Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" v-model="update_assignment.gender" value="Female">Female</label>
                                </div>
                             </div>
                             <span v-if="allerros.gender" :class="['label label-danger']">@{{ allerros.gender[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="biography">biography:</label>
                            <textarea name="biography" id="biography" cols="30" rows="5" class="form-control"
                                      placeholder="Biography" v-model="update_assignment.biography"></textarea>
                            <span v-if="allerros.biography" :class="['label label-danger']">@{{ allerros.biography[0] }}</span>
                        </div>
                        <div :class="['form-group', allerros.name ? 'has-error' : '']">
                            <label for="profile_picture">Profile Picture:</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <img :src="profile_picture" class="update-img" id="updateimg">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-8">
                                        <input type="file" v-on:change="onFileChange"  name="profile_picture" id="profile_picture" placeholder="profile picture"  class="form-control-file">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateAssignment" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="show_assignment_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Show Assignment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <img :src="profile_picture" id="showimg" width="200px">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                         <p>Name:<span class="name">{{ show_assignment.name }}</span> |
                                         Email:<span class="email">{{ show_assignment.email }}</span> |
                                         Phone:<span class="phone">{{ show_assignment.phone }}</span> |
                                         Gender: <span class="gender">{{ show_assignment.gender }}</span> |
                                         Date Of Birth:<span class="dob">{{ show_assignment.date_of_birth }}</span>
                                         </p>
                                         <p>{{ show_assignment.biography }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>
<style scoped>
    #indeximg {
      width: 200px;
    }
    #updateimg {
      width: 100px;
    }

    .full {
      width: 100%;
      height: auto;
    }
    #showimg {
      width: 550px;
      border-radius: 2px;
      box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.5);
      transition: width 1s;
    }
    img:hover {
      cursor: pointer;
    }
    span.name, span.email, span.phone, span.gender, span.dob{font-weight:bold;}

</style>
<script>
    // Import required dependencies
    import 'bootstrap/dist/css/bootstrap.css';

    // Import this component
    import datePicker from 'vue-bootstrap-datetimepicker';

    // Import date picker css
    import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';
    export default {
        data(){
            return {
                config: {
                  format: 'YYYY-MM-DD',
                  useCurrent: false
                },
                assignments: {
                    name: '',
                    email: '',
                    biography: '',
                    phone: '',
                    gender: '',
                    date_of_birth: ''
                },
                profile_picture: '',
                allerros: [],
                assignments: [],
                update_assignment: {},
                show_assignment: {}
            }
        },
        components: {
            datePicker
        },
        mounted()
        {
            this.readAssignments();
        },
        methods: {
            initAddAssignment()
            {
                this.allerros =[];
                $("#add_assignment_model").modal("show");
            },
            createAssignment()
            {
                axios.post('/assignments', {
                    name: this.assignments.name,
                    email:this.assignments.email,
                    phone:this.assignments.phone,
                    gender:this.assignments.gender,
                    date_of_birth:this.assignments.date_of_birth,
                    biography: this.assignments.biography,
                    profile_picture: this.profile_picture,
                })
                    .then(response => {
                        this.readAssignments();
                        this.reset();
                        $("#add_assignment_model").modal("hide");

                    })
                    .catch(error => {
                        this.allerros = error.response.data.errors;
                    });
            },
            reset()
            {
                this.assignments.name = '';
                this.assignments.email = '';
                this.assignments.phone = '';
                this.assignments.gender = '';
                this.assignments.date_of_birth = '';
                this.assignments.biography = '';
                this.profile_picture = '';
            },
            readAssignments()
            {
                axios.get('/assignments')
                    .then(response => {
                        this.assignments = response.data.assignments;
                    });
            },
            initUpdate(index)
            {
                this.allerros =[];
                $("#update_assignment_model").modal("show");
                this.update_assignment = this.assignments[index];
                this.profile_picture = this.update_assignment['profile_picture'];
            },
            updateAssignment()
            {
                axios.patch('/assignments/' + this.update_assignment.id, {
                    name: this.update_assignment.name,
                    email: this.update_assignment.email,
                    phone: this.update_assignment.phone,
                    gender: this.update_assignment.gender,
                    date_of_birth: this.update_assignment.date_of_birth,
                    biography: this.update_assignment.biography,
                    profile_picture: this.profile_picture,

                })
                    .then(response => {
                        profile_picture: '';
                        $("#update_assignment_model").modal("hide");

                    })
                    .catch(error => {
                        this.allerros = error.response.data.errors;
                    });
            },
            initShow(index)
            {
                $("#show_assignment_model").modal("show");
                this.show_assignment = this.assignments[index];
                this.profile_picture = this.show_assignment['profile_picture'];
            },
            deleteAssignment(index)
            {
                let conf = confirm("Do you ready want to delete this assignment?");
                if (conf === true) {

                    axios.delete('/assignments/' + this.assignments[index].id)
                        .then(response => {
                            this.assignments.splice(index, 1);
                        })
                        .catch(error => {

                        });
                }
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
               reader.onload = (e) => {
                    vm.profile_picture = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            upload(){
                axios.post('/assignments',{profile_picture: this.profile_picture}).then(response => {

                });
            }
        }
    }
</script>