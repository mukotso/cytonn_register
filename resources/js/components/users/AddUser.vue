<template>
<div>
 <div>
    <form @submit.prevent="isEditUser ? updateUser() : createUser()" class=" container mx-auto" action="#">
        <h3>
            {{ isEditUser ? "UPDATE USER DETAILS" : "CREATE A NEW USER" }}</h3>
       <div class="md:flex">
           <div class="md:w-1/2">
               <label >First Name</label>
               <input type="text" name="first_name"
                      placeholder="first name" required v-model="form.first_name">
           </div>

           <div class="md:w-1/2">
               <label >Last Name</label>
               <input type="text" name="last_name"
                      placeholder=" last name" required v-model="form.last_name">
           </div>
       </div>

        <div class="md:flex">
            <div class="md:w-1/2">
            <label >Email Address</label>
            <input type="email" name="email"
                   placeholder="email@gmail.com" required v-model="form.email">
        </div>

            <div class="md:w-1/2">
            <label >Phone Number</label>
            <input type="number" name="email"
                   placeholder="e.g 07895674324" required v-model="form.phone_number">
        </div>
        </div>
        <div class="md:w-1/2">
            <label>Department</label>
            <select v-model="form.department_id" id="department" required>
                <option  v-model="form.department_id" v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
            </select>
        </div>



        <button type="submit"
                class="btn-submit">
            {{ isEditUser ? "UPDATE USER DETAILS" : "SAVE USER" }}
        </button>

    </form>
    </div>
</div>
</template>

<script>
import Swal from "sweetalert2";
export default {
    name: "addUser",
    props:['form','isEditUser'],
    data() {
        return {
            departments:'',
        }
    },

    beforeMount() {
        axios.get('/departments')
            .then((response) => {
                    this.departments = response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
    },

    methods:{

        createUser() {
            axios.post('/user', this.form).then((response) => {

                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/users";
                        }
                    })
                this.isShowAddUserForm =false;
            }).catch((error) => {
                Swal.fire({
                    title: 'Error!',
                    text: Object.values(error.response.data.errors)[0],
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                })
            })

        },

        updateUser() {
            axios.put('/user/'+this.form.id, this.form).then((response) => {

                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/users";
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

