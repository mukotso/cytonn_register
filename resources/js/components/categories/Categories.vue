<template>
    <div>
        <div v-if="user.is_admin ==1">
            <button v-if="showCategories"
                    class="btn"
                    type="button" @click="toggleAddCategoryForm">
                <i class="fa fa-plus "></i> New Category
            </button>

            <button v-if="isShowAddCategoryForm"
                    class="btn"
                    type="button" @click="toggleshowCategories">
                <i class="fa fa-plus "></i> View All Categories
            </button>
        </div>

        <div v-if="isShowAddCategoryForm">
            <add-category
                :form="form"
                :isEditCategory="isEditCategory"
            >

            </add-category>
        </div>


        <section v-if="showCategories" class="container px-6 py-4 mx-auto">
            <div class="grid gap-6 mb-8 md:grid-cols-1 lg:grid-cols-2">

                <div v-for="(category ,index) in categories">
                    <div class="flex items-center p-4 bg-white border-2 border-gray-200 rounded-lg shadow-sm ">
                        <div id="body" class="flex flex-col ml-5">
                            <h4 id="name" class="text-xl font-semibold mb-2">{{ category.name }}</h4>
                            <h2>Description</h2>
                            <h4  class="text-xl  mb-2">{{ category.description }}</h4>
                            <div  v-if="user.is_admin ==1" class="flex mt-5">

                                <button @click="editCategory(category)"
                                        class=" m-3 block text-white bg-blue-400 hover:bg-blue-800   font-medium rounded-lg text-sm px-5 py-3"
                                >
                                    EDIT
                                </button>

                                <button
                                    class="m-3 block text-white bg-red-700 hover:bg-blue-800   font-medium rounded-lg text-sm px-5 py-3"
                                    @click.prevent="deleteCategory(category)">
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
import AddCategory from "./AddCategory";
import Swal from "sweetalert2";
export default {
    name: "Departments",
    components: {AddCategory},
    props: ['categories','user'],

    data() {
        return {
            isShowAddCategoryForm: false,
            showCategories: true,
            isEditCategory: false,
            form: {
                name: '',
                description:'',
                id:'',
            }
        }

    },
    mounted() {
        this.form.name="";
        this.form.id="";
        this.form.description="";
    },

    methods: {

        toggleAddCategoryForm() {
            this.isShowAddCategoryForm = !this.isShowAddCategoryForm;
            this.showCategories = false;
        },
        toggleshowCategories() {
            this.isShowAddCategoryForm = false;
            this.showCategories = true;
        },

        editCategory(category) {
            this.isEditCategory = true;
            this.isShowAddCategoryForm = true;
            this.showCategories = false;
            this.form= category;
        },

        deleteCategory(category) {
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
                    axios.delete('category/'+category.id).then((response) => {

                            console.log(response);
                            this.categories = this.categories.filter(response => response.id !== category.id)
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

