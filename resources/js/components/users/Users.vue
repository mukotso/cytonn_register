<template>
    <div>
       <div class="add-btn-div">
           <button v-if="showUsers"
                   class="btn"
                   type="button" @click="toggleAddUserForm">
               <i class="fa fa-plus "></i> New
           </button>

           <button v-if="isShowAddUserForm"
                   class="btn"
                   type="button" @click="toggleshowUsers">
               <i class="fa fa-plus "></i> All Users
           </button>
       </div>

        <div v-if="isShowAddUserForm">
            <add-user
                :form="form"
                :isEditUser="isEditUser"
            >

            </add-user>
        </div>


        <div v-if="showUsers" class="p-4">
            <div class="bg-white p-4 rounded-md">
                <div>
                    <h2 class="mb-4 text-xl font-bold text-gray-700">System User</h2>

                        </div>
                        <div>

                            <table>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                                <tr v-for="(user, index) in users">
                                    <td>{{ user.first_name }} {{ user.last_name }}</td>
                                    <td> {{ user.email }}</td>
                                    <td> {{ user.phone_number }}</td>
                                    <td> {{ user.department.name }}</td>
                                    <td>
                                       <div class="flex">
                                           <button @click="editUser(user)"
                                                   class=" m-3 py-2 block text-white bg-blue-400 hover:bg-blue-800  rounded-lg text-sm px-5 py-2.5 text-center"
                                           >
                                               EDIT
                                           </button>

                                           <button
                                               class="m-3 py-2 block text-white bg-red-700 hover:bg-blue-800  rounded-lg text-sm px-5  text-center "
                                               @click.prevent="deleteUser(user)">
                                               DELETE
                                           </button>
                                       </div>
                                    </td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

</template>

<script>
import addUser from "./AddUser";
import Swal from "sweetalert2";
export default {
    name: "Users",
    props: ['users'],
    components: {addUser},

    data() {
        return {
            isShowAddUserForm: false,
            showUsers: true,
            isEditUser: false,
            form: {
                first_name: '',
                last_name: '',
                email: '',
                phone_number: '',
                department_id: '',
                id: '',
            }
        }

    },
    mounted() {
        this.form.first_name = '';
        this.form.last_name = '';
        this.form.email = '';
        this.form.phone_number = '';
        this.form.department_id = '';
        this.form.id = '';
    },

    methods: {

        toggleAddUserForm() {
            this.isShowAddUserForm = !this.isShowAddUserForm;
            this.showUsers = false;
        },
        toggleshowUsers() {
            this.isShowAddUserForm = false;
            this.showUsers = true;
        },

        editUser(user) {
            this.isEditUser = true;
            this.isShowAddUserForm = true;
            this.showUsers = false;
            this.form = user;
        },

        deleteUser(user) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('users/'+user.id).then((response) => {

                            this.users = this.users.filter(response => response.id !== user.id)
                            Swal.fire({
                                title: 'Deleted!',
                                text: response.data['message'],
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            })

                    }).catch((error) => {
                        Swal.fire({
                            title: 'Error!',
                            text: Object.values(error.response.data.errors)[0],
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        })
                    })
                }
            })
        },
        }
    }
</script>

<style scoped>

</style>
