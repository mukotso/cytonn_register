<template>
    <div>
        <div class="add-btn-div">
           <button v-if="showEvents"
                   class="btn"
                   type="button" @click="toggleAddEventForm">
               <i class="fa fa-plus "></i>New
           </button>

           <button v-if="isShowAddEventForm"
                   class="btn"
                   type="button" @click="toggleshowEvents">
               <i class="fa fa-plus "></i> All Events
           </button>

            </div>

        <div v-if="isShowAddEventForm">
            <add-event
                :form="form"
                :isEditUser="isEditEvent"
            >

            </add-event>
        </div>

        <div v-if="!events.length && !isShowAddEventForm">
            <div class=" m-10 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p class=" m-5 font-bold">NO EVENTS ADDED</p>
                <p>Please add events to view them from here</p>
            </div>
        </div>



                <div v-if="showEvents && events.length" class=" md:mx-20  p-4">
                    <div class="bg-white p-4 rounded-md">
                        <div>
                            <h2 class="mb-4 text-xl font-bold text-gray-700">Events</h2>

                        </div>
                        <div>
                    <table>
                        <tr>
                            <th>Event Name</th>
                            <th>Category</th>
                            <th>Venue</th>
                            <th>Event Date</th>
                            <th> No. Activities</th>
                            <th>Frequency</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="(event, index) in events">
                            <td>{{ event.name }}</td>
                            <td>{{ event.category.name }}</td>
                            <td>{{ event.venue }}</td>
                            <td>{{ event.event_date }}</td>
                            <td>{{ event.activities.length }}</td>
                            <td>{{ event.frequency.name }}</td>
                            <td>
                                <div class="flex mt-2">
                                    <button
                                        class=" m-4 block text-white bg-green-400 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-3 text-center "
                                        @click.prevent="showEvent(event)">
                                        VIEW MORE
                                    </button>

                                    <button v-if=" user.is_admin==1 ||event.teamMembersUserIds.includes(user.id)"
                                            @click="editEvent(event)"
                                            class="m-4 block text-white bg-blue-400 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-3 text-center"
                                    >
                                        EDIT
                                    </button>

                                    <button v-if=" user.is_admin==1 ||event.teamMembersUserIds.includes(user.id)"
                                            class="  m-4 block text-white bg-red-700 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-3 text-center "
                                            @click.prevent="deleteEvent(event)">
                                        DELETE
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
import addEvent from "./AddEvent";
import Swal from "sweetalert2";

export default {
    name: "Events",
    props: ['events', 'user'],
    components: {addEvent},

    data() {
        return {
            isShowAddEventForm: false,
            showEvents: true,
            isEditEvent: false,
            form: {
                id: '',
                name: '',
                venue: '',
                category_id: '',
                frequency_id: '',
                event_date: '',
                lead_date: '',
                description: '',
            }
        }

    },
    beforeMount() {
        this.getTeamMembersUserIds();
        this.form.name = '',
            this.form.venue = '',
            this.form.category_id = '',
            this.form.frequency_id = '',
            this.form.start_date = '',
            this.form.event_date = '',
            this.form.description = '',
            this.form.status = 'active',
            this.form.user_id = '',
            this.form.is_owner = '',
            this.form.designation = ''
    },

    methods: {

        toggleAddEventForm() {
            this.isShowAddEventForm = !this.isShowAddEventForm;
            this.showEvents = false;
        },
        toggleshowEvents() {
            this.isShowAddEventForm = false;
            this.showEvents = true;
        },

        editEvent(event) {
            window.location.href = "/events/" + event.id + "/edit";
        },
        showEvent(event) {
            window.location.href = "/events/" + event.id;
        },
        getTeamMembersUserIds() {
            this.events.forEach(event => {
                let teamMembersUserIds = [];
                event.team_members.forEach(teamMembers => {
                    teamMembersUserIds.push(teamMembers.user_id);
                });
                event.teamMembersUserIds = teamMembersUserIds;
            });
        },

        deleteEvent(event) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('events/' + event.id).then((response) => {
                        this.events = this.events.filter(response => response.id !== event.id)
                        Swal.fire('Deleted!', 'Event has been deleted.', 'success')

                    }).catch((error) => {
                        Swal.fire({
                            title: 'Error!',
                            text: Object.values(error.response.data.errors)[0],
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        })
                    })
                }
            })
        },
    }
}
</script>

<style scoped>

</style>

