<template>
    <form class=" md:container md:mx-auto md:w-full sm:w-full" action="#">
        <h3>
            {{ "UPDATE EVENT DETAILS"}}</h3>
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
                <input type="datetime-local" required v-model="form.lead_time">
            </div>
        </div>

        <br>
        <label>EVENT ACTIVITIES</label>
        <br>
        <hr>
        <div class="md:flex">
            <div class="md:w-3/4">
                <label>Activity Description</label>
                <textarea type="text" rows="3" required v-model="newActivity.description"></textarea>
            </div>

            <div class="md:w-1/4">
                <button @click.prevent="saveActivity" class="btn-submit">SAVE</button>
            </div>
        </div>

        <table>
            <tr>
                <th>Activity</th>
                <th>Action</th>
            </tr>
            <tr v-for="(activity, index) in activities">
                <td>{{ activity.description}}</td>
                <td><button  @click.prevent="removeActivity(activity,index)" class="bg-red-600 px-2 py-1 rounded text-2xl text-white text-bold">Remove</button></td>
            </tr>

        </table>

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
                <button @click.prevent="saveTeamMember" class="btn-submit">SAVE</button>
            </div>
        </div>

        <div class="flex">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(teamMember, index) in teamMembers">
                    <td>{{ teamMember.user.first_name }} {{ teamMember.user.last_name }}</td>
                    <td>{{ teamMember.designation }}</td>
                    <td><button  @click.prevent="removeTeamMember(teamMember,index)" class="bg-red-600 px-2 py-1 rounded text-2xl text-white text-bold">Remove</button></td>
                </tr>

            </table>
        </div>

        <br>
        <hr>
        <br>

        <button type="submit" @click.prevent=" updateEvent()"
                class="btn-submit">
            {{ "UPDATE EVENT DETAILS"  }}
        </button>

    </form>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "addEvent",
    props: ['event'],
    data() {
        return {
            departments: '',
            frequencies: '',
            categories: '',
            users: '',
            newTeamMember: {},
            activities: [],
            newActivity: {},
            teamMembers: [],
            form:{}
        }
    },
    beforeMount() {
        this.form=this.event[0];
        for ( const activity  of this.event[0].activities) {
            this.activities.push(activity);
        }

        this.teamMembers=this.event[0].team_members;
        this.getDepartments();
        this.getCategories();
        this.getFrequencies();
        this.getUsers();
    },
    mounted() {
        console.log(this.event)
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
            this.newActivity={};
        },

        removeActivity(activity,index) {
            axios.get('/event/remove-activity/'+activity.id).then((response) => {
                if (response.status === 200) {
                     this.activities.splice(index, 1);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Activity Removed successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                }
            }).catch((error) => {
                 console.log(error);
            })

        },

        saveTeamMember() {
            this.teamMembers.push(this.newTeamMember);
            this.newTeamMember = {}
        },

        removeTeamMember(teamMember,index) {
            axios.get('/event/remove-team-member/'+teamMember.id).then((response) => {
                if (response.status === 200) {
                    this.teamMembers.splice(index, 1);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Member Removed successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                }
            }).catch((error) => {
                // console.log(error);
            })
        },

        updateEvent() {
            this.form.activities = this.activities;
            this.form.teamMembers = this.teamMembers;
            console.log(this.form);
            axios.put('/event/'+this.form.id, this.form).then((response) => {
                console.log(response)
                if (response.status === 200) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Event Details Updated successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/events";
                        }
                    })

                }
                this.isShowAddEventForm = false;
            }).catch((error) => {
                // console.log(error);
            })
        },

    }
}
</script>

<style scoped>
</style>



