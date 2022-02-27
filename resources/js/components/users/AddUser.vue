<template>
    <form class=" container mx-auto" action="#">
        <h3>
            {{ isEditUser ? "UPDATE USER DETAILS" : "CREATE A NEW USER" }}</h3>
        <div>
            <label >First Name</label>
            <input type="text" name="first_name"
                   placeholder="first name" required v-model="form.first_name">
        </div>

        <div>
            <label >Last Name</label>
            <input type="text" name="last_name"
                   placeholder=" last name" required v-model="form.last_name">
        </div>

        <div>
            <label >Email Address</label>
            <input type="email" name="email"
                   placeholder="email@gmail.com" required v-model="form.email">
        </div>

        <div>
            <label >Phone Number</label>
            <input type="email" name="email"
                   placeholder="e.g 07895674324" required v-model="form.phone_number">
        </div>

        <div>
            <label>Department</label>
            <select v-model="form.department_id" id="department">
                <option  v-model="form.department_id" v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
            </select>
        </div>



        <button type="submit" @click.prevent="isEditUser ? updateUser() : createUser()"
                class="btn-submit">
            {{ isEditUser ? "UPDATE USER DETAILS" : "SAVE USER" }}
        </button>

    </form>
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
                if(response.status===200){
                    this.departments = response.data;
                }
            })
            .catch(function (error) {
                console.log(error);
            })
    },

    methods:{

        createUser() {
            console.log(this.form);
            axios.post('/user', this.form).then((response) => {
                if(response.status===200){
                    Swal.fire({
                        title: 'Success!',
                        text: 'User added successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })

                }
                this.isShowAddUserForm =false;
            }).catch((error) => {

                console.log(error);
            })
        },

        updateUser() {
            axios.put('/user/'+this.form.id, this.form).then((response) => {
                if (response.status === 200) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User Details Updated successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                }
            }).catch((error) => {
                console.log(error);
            })
        },
    }
}
</script>

<style scoped>

</style>

