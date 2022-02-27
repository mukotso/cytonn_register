<template>
    <form class=" container mx-auto" action="#">
        <h3>
            {{ isEditEvent ? "UPDATE EVENT DETAILS" : "CREATE A NEW EVENT" }}</h3>
        <br>
        <label>EVENT DETAILS</label>
        <br>
        <hr>
        <div>

            <label >Event Name</label>
            <input type="text"
                   placeholder="event form" required v-model="form.eventForm.name">
        </div>

        <div>

            <label >Event Venue</label>
            <input type="text"
                   placeholder="event form" required v-model="form.eventForm.venue">
        </div>

        <div>
            <label>Category</label>
            <select>
                <option selected disabled>Select Event Category</option>
                <option  v-model="form.eventForm.category_id"  v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
            </select>
        </div>

        <div>
            <label>Frequency</label>
            <select>
                <option selected disabled>Select Event Frequency</option>
                <option  v-model="form.eventForm.frequency_id"  v-for="frequency in frequencies" :key="frequency.id" :value="frequency.id">{{ frequency.name }}</option>
            </select>
        </div>

        <div>
            <label>Department</label>
            <select>
                <option  v-model="form.department_id" v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
            </select>
        </div>

        <div>
            <label >Event Date</label>
            <input type="datetime-local" required v-model="form.eventForm.start_date">
        </div>

        <br>
        <label class="m-20">EVENT ACTIVITIES</label>
        <br>
        <hr>

        <div>
            <label >Activity Description</label>
            <textarea type="text" rows="5" required v-model="form.activityForm.description"></textarea>
        </div>

        <button class="btn-submit">ADD</button>

        <br>
        <label class="m-20">EVENT TEAM MEMBERS</label>
        <br>
        <hr>

        <div>
            <label>Select Member</label>
            <select>
                <option selected disabled>Select Event Team Member</option>
                <option  v-model="form.eventTeamMemberForm.user_id"  v-for="user in users" :key="user.id" :value="user.id">{{ user.first_name }} {{ user.last_name }}</option>
            </select>
        </div>

        <div>

            <label >Designation</label>
            <input type="text"
                   placeholder="e.g secretary,organizing secretary" required v-model="form.eventTeamMemberForm.designation">
        </div>

        <button class="btn-submit">ADD</button>
<br>
        <hr>
        <br>

        <button type="submit" @click.prevent="isEditEvent ? updateEvent() : createEvent()"
                class="btn-submit">
            {{ isEditEvent ? "UPDATE EVENT DETAILS" : "SAVE EVENT" }}
        </button>

    </form>
</template>

<script>
import Swal from "sweetalert2";
export default {
    name: "addEvent",
    props:['form','isEditEvent'],
    data() {
        return {
            departments:'',
            frequencies:'',
            categories:'',
            users:'',
        }
    },
    beforeMount() {
        this.getDepartments();
        this.getCategories();
        this.getFrequencies();
        this.getUsers();
    },

    methods:{

        getDepartments(){
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
        getCategories(){
            axios.get('/categories')
                .then((response) => {
                    if(response.status===200){
                        this.categories = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        getFrequencies(){
            axios.get('/frequencies')
                .then((response) => {
                    if(response.status===200){
                        this.frequencies = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        getUsers(){
            axios.get('/users')
                .then((response) => {
                    if(response.status===200){
                        this.users = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        createEvent() {
            console.log(this.form);
            axios.post('/event', this.form).then((response) => {
                if(response.status===200){
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event added successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })

                }
                this.isShowAddEventForm =false;
            }).catch((error) => {

                console.log(error);
            })
        },

        updateEvent() {
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


