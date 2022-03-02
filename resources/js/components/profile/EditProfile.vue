<template>
 <div>
     <form @submit.prevent="updateProfile()" class=" container mx-auto" action="#">
         <h1>UPDATE DETAILS </h1>
         <h3>PERSONAL INFORMATION</h3>
         <hr>
         <div class="md:flex">
             <div class="md:w-1/2">
                 <label>First Name</label>
                 <input type="text" name="first_name"
                        placeholder="first name" required v-model="form.first_name">
             </div>

             <div class="md:w-1/2">
                 <label>Last Name</label>
                 <input type="text" name="last_name"
                        placeholder=" last name" required v-model="form.last_name">
             </div>
         </div>

         <div class="md:flex">
             <div class="md:w-1/2">
                 <label>Email Address</label>
                 <input type="email" name="email"
                        placeholder="email@gmail.com" required v-model="form.email">
             </div>

             <div class="md:w-1/2">
                 <label>Phone Number</label>
                 <input type="number" name="email"
                        placeholder="e.g 07895674324" required v-model="form.phone_number">
             </div>
         </div>
         <div class="md:w-1/2">
             <label>Department</label>
             <select v-model="form.department_id" id="department">
                 <option v-model="form.department_id" v-for="department in departments" :key="department.id"
                         :value="department.id">{{ department.name }}
                 </option>
             </select>
         </div>


         <button  type="submit"
                 class="btn-submit">
             UPDATE  DETAILS
         </button>

     </form>


     <form @submit.prevent="updatePassword" class=" container mx-auto" action="#">
         <br>
         <h1>AUTHENTICATION</h1>
         <br>
         <hr>
         <div class="md:w-1/2">
             <label>Old Password</label>
             <input type="password" name="oldpassword"
                    placeholder="xxxxxxxxx" required v-model="authenticationForm.oldpassword">
         </div>

         <div class="md:w-1/2">
             <label>New Password</label>
             <input type="password" name="password"
                    placeholder="xxxxxxxx" required v-model="authenticationForm.password">
         </div>

         <div class="md:w-1/2">
             <label>Confirm Password</label>
             <input type="password" name="password_confirmation"
                    placeholder="xxxxxxxx" required v-model="authenticationForm.password_confirmation">
         </div>

         <button type="submit"
                 class="btn-submit">
             CHANGE PASSWORD
         </button>

     </form>
 </div>

</template>

<script>
import Swal from "sweetalert2";

export default {
    props:['form'],
    data(){
        return{
            departments:'',
            authenticationForm:{},
        }
    },
    beforeMount() {
        axios.get('/departments')
            .then((response) => {
                    this.departments = response.data;
            })
            .catch(function (error) {
                Swal.fire({
                    title: 'Error!',
                    text: Object.values(error.response.data.errors)[0],
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                })
            })
    },

    methods:{
        updateProfile() {
            axios.put('/user/'+this.form.id, this.form).then((response) => {
                if (response.status === 200) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/profile";
                        }
                    })
                }
            }).catch((error) => {
                Swal.fire({
                    title: 'Error!',
                    text: Object.values(error.response.data.errors)[0],
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                })
            })
        },
        updatePassword() {
            axios.post('/profile/update-password', this.authenticationForm).then((response) => {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/profile";
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
