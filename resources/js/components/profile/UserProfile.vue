<template>
  <div>
      <form v-if="showProfile" class=" container mx-auto" action="#">
          <h3>PROFILE PAGE</h3>
          <div class="md:flex">
              <div class="md:w-1/2">
                  <h1 >First Name</h1>
                  <h2>{{user.first_name}}</h2>
              </div>

              <div class="md:w-1/2">
                  <h1 >Last Name</h1>
                  <h2>{{user.last_name}}</h2>
              </div>
          </div>

          <div class="md:flex">
              <div class="md:w-1/2">
                  <h1 >Email Address</h1>
                  <h2>{{user.email}}</h2>
              </div>

              <div class="md:w-1/2">
                  <h1 >Phone Number</h1>
                  <h2>{{user.phone_number}}</h2>
              </div>
          </div>
          <div class="md:w-1/2">
              <h1>Department</h1>
              <h2>{{user.department.name}}</h2>
          </div>
          <button  @click.prevent="editProfile(user)" type="submit"
                   class="btn-submit">
              EDIT DETAILS
          </button>
      </form>

      <div v-if="isShowEditProfile">
          <edit-profile
              :form="form"
          >
          </edit-profile>
      </div>
  </div>

</template>

<script>
import editProfile from "./EditProfile";
export default {
    props: ['user'],
components:{editProfile},
    data(){
       return{
           isShowEditProfile:'',
           showProfile:'',
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
    beforeMount() {
        this.showProfile=true;
    },
    methods:{
        editProfile(user) {
            this.isShowEditProfile = true;
            this.showProfile = false;
            this.form = user;
        },
    }
}
</script>

<style scoped>


h1 {
    color: gray;
    font-weight: bold;
    font-size: 20px;
}

h2 {
    color: black;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
}
</style>
