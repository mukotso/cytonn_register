<template>
    <div>
        <button v-if="showUsers"
                class="btn"
                type="button" @click="toggleAddUserForm">
            <i class="fa fa-plus "></i> New User
        </button>

        <button v-if="isShowAddUserForm"
                class="btn"
                type="button" @click="toggleshowUsers">
            <i class="fa fa-plus "></i> View All Users
        </button>

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
                    <div>
                        <div>
                            <div
                                class="flex justify-between bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-md py-2 px-4 text-white font-bold text-md">
                                <div>
                                    <span>Name</span>
                                </div>
                                <div>
                                    <span>Email</span>
                                </div>
                                <div>
                                    <span>Phone Number</span>
                                </div>
                                <div>
                                    <span>Department</span>
                                </div>
                                <div>
                                    <span>ACTION</span>
                                </div>
                            </div>
                            <div v-for="(user, index) in users">
                                <div class="flex justify-between border-t text-sm font-normal mt-4 space-x-4">
                                    <div class="px-2 flex">
                                        <span>{{ user.first_name }} {{ user.last_name }}</span>
                                    </div>
                                    <div>
                                        <span>{{ user.email }}</span>
                                    </div>
                                    <div>
                                        <span>{{ user.phone_number }}</span>
                                    </div>
                                    <div>
                                        <span>{{ user.department_id }}</span>
                                    </div>
                                    <div class="flex mt-5">

                                        <button @click="editUser(user)"
                                                class=" m-3 block text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            EDIT
                                        </button>

                                        <button
                                            class="m-3 block text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            @click.prevent="deleteUser(user)">
                                            DELETE
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
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
                    axios.delete('user/'+user.id).then((response) => {
                        if (response.status === 200) {
                            this.users = this.users.filter(response => response.id !== user.id)
                            Swal.fire('Deleted!', 'User has been deleted.', 'success')
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    }).catch((error) => {
                        console.log('An error occured');
                    })
                }
            })
        },
        }
    }
</script>

<style scoped>

</style>
