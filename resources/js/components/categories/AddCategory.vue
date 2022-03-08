<template>
    <form @submit.prevent="isEditCategory ? updateCategory() : createCategory()" class=" container mx-auto" action="#">
        <h3>
            {{ isEditCategory ? "UPDATE CATEGORY DETAILS" : "CREATE A NEW EVENT CATEGORY" }}</h3>
        <div>
            <label >Name</label>
            <input type="text" name="name"
                   placeholder="name" required v-model="form.name">
        </div>

        <div>
            <label >Description</label>
            <textarea type="text" v-model="form.description"
                      placeholder="brief category description"
                      required name="description" rows="5" ></textarea>

        </div>


        <button type="submit"
                class="btn-submit">
            {{ isEditCategory ? "UPDATE DETAILS" : "SUBMIT" }}
        </button>

    </form>
</template>

<script>
import Swal from "sweetalert2";
export default {
    name: "addDepartment",
    props:['form','isEditCategory'],
    data() {
        return {
        }
    },
    methods:{

        createCategory() {
            axios.post('/categories', this.form).then((response) => {

                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/categories";
                        }
                    })

                this.isShowAddCategoryForm =false;
            }).catch((error) => {
                Swal.fire({
                    title: 'Error!',
                    text: Object.values(error.response.data.errors)[0],
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                })
            })
        },

        updateCategory() {
            axios.put('/categories/'+this.form.id, this.form).then((response) => {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/categories";
                        }
                    })

            }).catch((error) => {
                Swal.fire({
                    title: 'Error!',
                    text: Object.values(error.response.data.errors)[0],
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                })
            })
        },
    }
}
</script>

<style scoped>

</style>
