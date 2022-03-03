<template>
    <form class=" md:container md:mx-auto md:w-full sm:w-full" action="#">

        <br>
        <h1>EVENT DETAILS</h1>
        <br>
        <hr>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">
                <h1>Event Name</h1>
                <h2>{{ event[0].name }}</h2>
            </div>

            <div class="sm:w-full md:w-1/2 ">

                <h1>Event Venue</h1>
                <h2>{{ event[0].venue }}</h2>
            </div>
        </div>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">
                <h1>Event Category</h1>
                <h2>{{ event[0].category.name }}</h2>
            </div>

            <div class="sm:w-full md:w-1/2 ">
                <h1>Event Frequency</h1>
                <h2>{{ event[0].frequency.name }}</h2>
            </div>
        </div>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">
                <h1>Event Date</h1>
                <h2>{{ event[0].event_date }}</h2>
            </div>

            <div class="sm:w-full md:w-1/2 ">
                <h1>Lead Date</h1>
                <h2>{{ event[0].lead_time }}</h2>
            </div>
        </div>
        <br>
        <h1>EVENT ACTIVITIES</h1>
        <br>
        <hr>

        <div v-if="!event[0].activities.length">
            <div class=" m-10 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p class=" m-5 font-bold">NO EVENT ACTIVITIES ADDED</p>
            </div>
        </div>

        <table v-else>
            <tr>
                <th>Activity</th>
                <th>Status</th>
                <th v-if="user.is_admin==1 ||event.teamMembersUserIds.includes(user.id)">Action</th>

            <tr v-for="(activity, index) in event[0].activities">

                <td>{{ activity.description }}</td>
                <td v-if="activity.status=='active'"><span class="statusActive"></span> On time</td>
                <td v-if="activity.status=='inactive'"><span class="statusInactive"></span>Not happpening</td>
                <td v-if="activity.status=='completed'">
                    <del><span class="statusDone"></span>Done</del>
                </td>
                <td v-if="user.is_admin==1 ||event.teamMembersUserIds.includes(user.id)">
                    <button v-if="activity.status=='active'"
                            @click.prevent="completeActivity(activity)"
                            class="bg-green-400 text-white text-bold px-2 py-1">Mark As Completed
                    </button>
                    <button v-if="activity.status=='active'"
                            @click.prevent="activityNotHappening(activity)"
                            class="bg-red-400 text-white text-bold px-2 py-1">Not Happening
                    </button>

                    <h2 v-if="activity.status=='completed' " class="text-bold text-green-400 text-bold px-2 py-1">
                        DONE</h2>
                    <h2 v-if="activity.status=='inactive'" class="text-bold text-red-400 text-bold px-2 py-1">NOT
                        HAPPENING</h2>
                </td>

            </tr>

        </table>


        <br>
        <h1 class="heading">EVENT TEAM MEMBERS</h1>
        <br>
        <h1 class="heading">Event Host</h1>
        <hr>

        <div class="flex">
            <div class="md:w-1/3">
                <h1>Name</h1>
                <h2>{{ event[0].creator.first_name }} {{ event[0].creator.last_name }}</h2>
            </div>

            <div class="md:w-1/3">
                <h1>Email</h1>
                <h2>{{ event[0].creator.email }}</h2>
            </div>

            <div class="md:w-1/3">
                <h1>Tel</h1>
                <h2>{{ event[0].creator.phone_number }}</h2>
            </div>

        </div>
        <hr>
        <br>
        <h1 class="heading">Members</h1>
        <br>
        <div v-if="!event[0].team_members.length">
            <div class=" m-10 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p class=" m-5 font-bold">NO EVENT TEAM MEMBERS ADDED</p>
            </div>
        </div>
        <div v-else class="flex">

            <table>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                </tr>
                <tr v-for="(teamMember, index) in event[0].team_members">
                    <td>{{ teamMember.user.first_name }} {{ teamMember.user.last_name }}</td>
                    <td>{{ teamMember.designation }}</td>
                </tr>

            </table>
        </div>

        <br>
        <hr>
        <br>


    </form>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "showEvent",
    props: ['event', 'user'],

    beforeMount() {
        this.getTeamMembersUserIds();
        console.log(this.event);
    },
    methods: {
        completeActivity(activity) {
            axios.get('/event/complete-activity/' + activity.id).then((response) => {
                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/event/" + activity.event_id;
                        }
                    })

                }
            ).catch((error) => {
                Swal.fire({
                    title: 'Error!',
                    text: Object.values(error.response.data.errors)[0],
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                })

            })
                },
                activityNotHappening(activity)
            {
                axios.get('/event/activity-not-happening/' + activity.id).then((response) => {

                    Swal.fire({
                        title: 'Success!',
                        text: response.data['message'],
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/event/" + activity.event_id;
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

            getTeamMembersUserIds()
            {
                let teamMembersUserIds = [];
                this.event[0].team_members.forEach(teamMember => {
                    teamMembersUserIds.push(teamMember.user_id);
                });
                this.event.teamMembersUserIds = teamMembersUserIds;
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

.heading {
    color: black !important;
}

h2 {
    color: black;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
}
</style>



