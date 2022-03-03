<template>
    <div>

        <button v-if="showDepartments"
                class="btn"
                type="button" @click="toggleAddDepartmentForm">
            <i class="fa fa-plus "></i> New Department
        </button>

        <button v-if="isShowAddDepartmentForm"
                class="btn"
                type="button" @click="toggleshowDepartments">
            <i class="fa fa-plus "></i> View All Departments
        </button>

        <div v-if="isShowAddDepartmentForm">
            <add-department
                :form="form"
                :isEditDepartment="isEditDepartment"
            >

            </add-department>
        </div>


        <div v-else-if="!departments.length && !isShowAddDepartmentForm">
            <div class=" m-10 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p class=" m-5 font-bold">NO DEPARTMENTS ADDED</p>
                <p>Please add Departments to view them from here</p>
            </div>
        </div>

        <section v-if="showDepartments" class="container px-6 py-4 mx-auto">
            <div class="grid gap-6 mb-8 md:grid-cols-1 lg:grid-cols-2">

                <div v-for="(department ,index) in departments">
                    <div class="flex items-center p-4 bg-white border-2 border-gray-200 rounded-lg shadow-sm ">
                        <div id="body" class="flex flex-col ml-5">
                            <h4 id="name" class="text-xl font-semibold mb-2">{{ department.name }}</h4>
                            <div class="flex mt-5">

                                <button @click="editDepartment(department)"
                                        class=" m-3 block text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    EDIT
                                </button>

                                <button
                                    class="m-3 block text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    @click.prevent="deleteDepartment(department)">
                                    DELETE
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </div>
</template>

<script>
import AddDepartment from "./addDepartment";
import Swal from "sweetalert2";
export default {
    name: "Departments",
    components: {AddDepartment},
    props: ['departments'],

    data() {
        return {
            isShowAddDepartmentForm: false,
            showDepartments: true,
            isEditDepartment: false,
            form: {
                name: '',
                id:'',
            }
        }

    },
    mounted() {
        this.form.name="";
        this.form.id="";
    },

    methods: {

        toggleAddDepartmentForm() {
            this.isShowAddDepartmentForm = !this.isShowAddDepartmentForm;
            this.showDepartments = false;
        },
        toggleshowDepartments() {
            this.isShowAddDepartmentForm = false;
            this.showDepartments = true;
        },

        editDepartment(department) {
            this.isEditDepartment = true;
            this.isShowAddDepartmentForm = true;
            this.showDepartments = false;
            this.form= department;
        },

        deleteDepartment(department) {
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
                    axios.delete('department/'+department.id).then((response) => {

                            console.log(response);
                            this.departments = this.departments.filter(response => response.id !== department.id)
                            Swal.fire({
                                title: 'Success!',
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
