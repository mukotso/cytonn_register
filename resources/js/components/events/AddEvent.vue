<template>
    <form @submit.prevent=" createEvent()" class=" md:container md:mx-auto md:w-full sm:w-full" action="#">
        <h3>{{ "CREATE A NEW EVENT" }}</h3>
        <br>
        <label>EVENT DETAILS</label>
        <br>
        <hr>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">
                <label>Event Name</label>
                <input type="text"
                       placeholder="Event Name" required v-model="form.name">
            </div>

            <div class="sm:w-full md:w-1/2 ">

                <label>Event Venue</label>
                <input type="text"
                       placeholder="Venue" required v-model="form.venue">
            </div>
        </div>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">
                <label>Select Category</label>
                <select v-model="form.category_id" required>
                    <option v-model="form.category_id" v-for="category in categories" :key="category.id"
                            :value="category.id">{{ category.name }}
                    </option>
                </select>
            </div>

            <div class="sm:w-full md:w-1/2 ">
                <label>After How long Does it Happen</label>
                <select v-model="form.frequency_id" required>
                    <option v-model="form.frequency_id" v-for="frequency in frequencies" :key="frequency.id"
                            :value="frequency.id">{{ frequency.name }}
                    </option>
                </select>
            </div>

        </div>
        <div class="md:flex">

            <div class="sm:w-full md:w-1/2 ">
                <label>Event Date</label>
                <input type="date" required v-model="form.event_date">
            </div>

            <div class="sm:w-full md:w-1/2 ">
                <label>When Should Preparations Start</label>
                <input type="date" required v-model="form.lead_date">
            </div>
        </div>

        <br>
        <label>Select Departments That Apply</label>
        <div class="md:flex">
            <div class="md:w-1/4"  v-for="department in departments" :key="department.id">
               <div class="md:w-full">
                   <div class="checkbox-group required">
                       <input class="checkbox" type="checkbox" :value="department.id" v-model="departmentIds" >
                       <span>{{ department.name }}</span> <br>
                   </div>
               </div>
            </div>
        </div>

        <br>
        <label>EVENT ACTIVITIES</label>
        <br>
        <hr>

        <form @submit.prevent="saveActivity">
            <div class="md:flex">
                <div class="md:w-3/4">
                    <label>Activity Description</label>
                    <textarea type="text" rows="3" required v-model="newActivity.description"></textarea>
                </div>

                <div class="md:w-1/4">
                    <button class="btn-submit">
                        <i class="fa fa-plus"></i> ADD
                    </button>
                </div>
            </div>
        </form>
        <table v-if="activities.length >0">
            <tr>
                <th>Activity</th>
                <th>Action</th>
            </tr>
            <tr v-for="(activity, index) in activities">
                <td>{{ activity.description }}</td>
                <td>
                    <button @click.prevent="removeActivity(activity,index)"
                            class="bg-red-600 px-2 py-1 rounded text-2xl text-white text-bold">Remove
                    </button>
                </td>
            </tr>

        </table>

        <br>
        <label>EVENT TEAM MEMBERS</label>
        <br>
        <hr>

        <form @submit.prevent="saveTeamMember">
            <div class="md:flex">
                <div class="md:w-1/3">
                    <label>Select Member</label>
                    <select v-model="newTeamMember.user" required>
                        <option v-for="user in users" :key="user.id"
                                :value="user">{{ user.first_name }} {{ user.last_name }}
                        </option>
                    </select>
                </div>

                <div class="md:w-1/3">

                    <label>Designation</label>
                    <input type="text"
                           placeholder="e.g secretary,organizing secretary" required
                           v-model="newTeamMember.designation">
                </div>

                <div class="md:w-1/3">
                    <button class="btn-submit">
                        <i class="fa fa-plus"></i> ADD
                    </button>
                </div>
            </div>
        </form>

        <div class="flex">
            <table v-if="teamMembers.length > 0">
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(teamMember, index) in teamMembers">
                    <td>{{ teamMember.user.first_name }}</td>
                    <td>{{ teamMember.designation }}</td>
                    <td>
                        <button @click="removeTeamMember(index)"
                                class="bg-red-600 px-2 py-1 rounded text-2xl text-white text-bold">Remove
                        </button>
                    </td>
                </tr>

            </table>
        </div>

        <br>
        <hr>
        <br>

        <button type="submit"
                class="btn-submit">
            {{ "SAVE EVENT" }}
        </button>

    </form>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "addEvent",
    props: ['form'],
    data() {
        return {
            departments: '',
            frequencies: '',
            categories: '',
            users: '',
            newTeamMember: {},
            newActivity: {},
            activities: [],
            teamMembers: [],
            departmentIds: []
        }
    },
    beforeMount() {
        this.getDepartments();
        this.getCategories();
        this.getFrequencies();
        this.getUsers();
        console.log(this.departments);
    },

    methods: {

        getDepartments() {
            axios.get('/departments')
                .then((response) => {
                    if (response.status === 200) {
                        this.departments = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        getCategories() {
            axios.get('/categories')
                .then((response) => {
                    if (response.status === 200) {
                        this.categories = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        getFrequencies() {
            axios.get('/frequencies')
                .then((response) => {
                    if (response.status === 200) {
                        this.frequencies = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        getUsers() {
            axios.get('/users')
                .then((response) => {
                    if (response.status === 200) {
                        this.users = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
        },


        saveActivity() {
            this.activities.push(this.newActivity);
            this.newActivity = {};
        },

        removeActivity(index) {
            this.activities.splice(index, 1);
            // console.log(this.activities);
        },

        saveTeamMember() {
            this.teamMembers.push(this.newTeamMember);
            this.newTeamMember = {}
            // console.log(this.teamMembers);
        },

        removeTeamMember(index) {
            this.teamMembers.splice(index, 1);
            // console.log(this.teamMembers);
        },

        createEvent() {
            this.form.activities = this.activities;
            this.form.teamMembers = this.teamMembers;
            this.form.departmentIds = this.departmentIds;
            axios.post('/events', this.form).then((response) => {
                console.log(response)

                Swal.fire({
                    title: 'Success!',
                    text: response.data['message'],
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/events";
                    }
                })


                this.isShowAddEventForm = false;
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

<style>

</style>


