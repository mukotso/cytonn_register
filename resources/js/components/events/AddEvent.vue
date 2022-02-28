<template>
    <form class=" md:container md:mx-auto md:w-full sm:w-full" action="#">
        <h3>
            {{ isEditEvent ? "UPDATE EVENT DETAILS" : "CREATE A NEW EVENT" }}</h3>
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
                <select v-model="form.category_id">
                    <option v-model="form.category_id" v-for="category in categories" :key="category.id"
                            :value="category.id">{{ category.name }}
                    </option>
                </select>
            </div>

            <div class="sm:w-full md:w-1/2 ">
                <label>After How long Does it Happen</label>
                <select v-model="form.frequency_id">
                    <option v-model="form.frequency_id" v-for="frequency in frequencies" :key="frequency.id"
                            :value="frequency.id">{{ frequency.name }}
                    </option>
                </select>
            </div>
        </div>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">

                <label>Add Department(s)</label>
                <select v-model="form.department_id">
                    <option v-model="form.department_id" v-for="department in departments" :key="department.id"
                            :value="department.id">{{ department.name }}
                    </option>
                </select>
            </div>

            <div class="sm:w-full md:w-1/2 ">
                <label>Event Date</label>
                <input type="datetime-local" required v-model="form.event_date">
            </div>
        </div>

        <div class="flex">
            <div class="sm:w-full md:w-1/2 ">
                <label>Lead Date</label>
                <input type="datetime-local" required v-model="form.lead_date">
            </div>
        </div>

        <br>
        <label>EVENT ACTIVITIES</label>
        <br>
        <hr>

        <div class="md:flex">
            <div class="md:w-3/4">
                <label>Activity Description</label>
                <textarea type="text" rows="3" required v-model="form.description"></textarea>
            </div>

            <div class="md:w-1/4">
                <button @click="saveActivity" class="btn-submit">SAVE</button>
            </div>
        </div>


        <div class="flex">
            <div v-for="(activity, index) in activities">
                <h1 @click="removeActivity(index)" class="mx-2">{{ activity }}</h1>
            </div>
        </div>

        <br>
        <label>EVENT TEAM MEMBERS</label>
        <br>
        <hr>

        <div class="md:flex">
            <div class="md:w-1/3">
                <label>Select Member</label>
                <select v-model="newTeamMember.user">
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
                <button @click="saveTeamMember" class="btn-submit">SAVE</button>
            </div>
        </div>

        <div class="flex">

            <!--                <table>-->
            <!--                    <tbody>-->
            <!--                    <tr>-->
            <!--                        <th>Name</th>-->
            <!--                        <th>Designation</th>-->
            <!--                    </tr>-->
            <!--                    <tr v-for="(teamMember, index) in teamMembers">-->
            <!--                    <td>{{teamMember.user.first_name}}</td>-->
            <!--                    <td>{{teamMember.designation}}</td>-->
            <!--                    </tr>-->
            <!--                    </tbody>-->
            <!--                </table>-->

            <table>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(teamMember, index) in teamMembers">
                    <td>{{ teamMember.user.first_name }}</td>
                    <td>{{ teamMember.designation }}</td>
                    <td><button  @click="removeTeamMember(index)" class="bg-red-600 px-2 py-1 rounded text-2xl text-white text-bold">Remove</button></td>
                </tr>

            </table>
        </div>

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
    props: ['form', 'isEditEvent'],
    data() {
        return {
            departments: '',
            frequencies: '',
            categories: '',
            users: '',
            newTeamMember: {},
            activities: [],
            teamMembers: []
        }
    },
    beforeMount() {
        this.getDepartments();
        this.getCategories();
        this.getFrequencies();
        this.getUsers();
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
            this.activities.push(this.form.description);
            this.form.description = '';
            // console.log(this.activities);
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
            // console.log(this.form)
            axios.post('/event', this.form).then((response) => {
                console.log(response)
                if (response.status === 200) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event added successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })

                }
                this.isShowAddEventForm = false;
            }).catch((error) => {
                // console.log(error);
            })
        },

        updateEvent() {
            axios.put('/user/' + this.form.id, this.form).then((response) => {
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
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>


