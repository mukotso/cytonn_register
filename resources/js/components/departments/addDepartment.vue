<template>
    <form @submit.prevent="isEditDepartment ? updateDepartment() : createDepartment()" class=" container mx-auto"
          action="#">
        <h3>
            {{ isEditDepartment ? "UPDATE DEPARTMENT NAME" : "CREATE A NEW DEPARTMENT" }}</h3>
        <div>
            <label>Name</label>
            <input type="text" name="name"
                   placeholder="name" required v-model="form.name">
        </div>


        <button type="submit"
                class="btn-submit">
            {{ isEditDepartment ? "UPDATE DETAILS" : "SUBMIT" }}
        </button>

    </form>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "addDepartment",
    props: ['form', 'isEditDepartment'],
    data() {
        return {}
    },
    methods: {

        createDepartment() {
            axios.post('/department', this.form).then((response) => {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/departments";
                        }
                    })

                this.isShowAddDepartmentForm = false;
            }).catch((error) => {
                Swal.fire({
                    title: 'Error!',
                    text: Object.values(error.response.data.errors)[0],
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                })
            })
        },

        updateDepartment() {
            axios.put('/department/' + this.form.id, this.form).then((response) => {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/departments";
                        }
                    })

            }).catch((error) => {
                console.log(Object.values(error.response.data.errors)[0][0])
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
