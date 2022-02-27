<template>
    <div>
        <button v-if="showEvents"
                class="btn"
                type="button" @click="toggleAddEventForm">
            <i class="fa fa-plus "></i> New Event
        </button>

        <button v-if="isShowAddEventForm"
                class="btn"
                type="button" @click="toggleshowEvents">
            <i class="fa fa-plus "></i> View All Events
        </button>

        <div v-if="isShowAddEventForm">
            <add-event
                :form="form"
                :isEditUser="isEditEvent"
            >

            </add-event>
        </div>


        <div v-if="showEvents" class="p-4">
            <div class="bg-white p-4 rounded-md">
                <div>
                    <h2 class="mb-4 text-xl font-bold text-gray-700">Events</h2>
                    <div>
                        <div>
                            <div
                                class="flex justify-between bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-md py-2 px-4 text-white font-bold text-md">
                                <div>
                                    <span>Event Name</span>
                                </div>

                                <div>
                                    <span>Category</span>
                                </div>
                                <div>
                                    <span>Venue</span>
                                </div>
                                <div>
                                    <span>Date</span>
                                </div>
                                <div>
                                    <span>Department(s)</span>
                                </div>
                                <div>
                                    <span>ACTION</span>
                                </div>
                            </div>
                            <div v-for="(event, index) in events">
                                <div class="flex justify-between border-t text-sm font-normal mt-4 space-x-4">
                                    <div class="px-2 flex">
                                        <span>{{ event.name }}</span>
                                    </div>
                                    <div>
                                        <span>{{ event.category_id }}</span>
                                    </div>
                                    <div>
                                        <span>{{ event.venue }}</span>
                                    </div>
                                    <div>
                                        <span>{{ event.date }}</span>
                                    </div>
                                    <div>
                                        <span>{{ event.department_id }}</span>
                                    </div>
                                    <div class="flex mt-5">

                                        <button @click="editEvent(event)"
                                                class=" m-3 block text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            EDIT
                                        </button>

                                        <button
                                            class="m-3 block text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                            @click.prevent="deleteEvent(event)">
                                            DELETE
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
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
    props: ['events'],
    components: {addEvent},

    data() {
        return {
            isShowAddEventForm: false,
            showEvents: true,
            isEditEvent: false,
            form: {
                eventForm: {
                    id:'',
                    name: '',
                    venue: '',
                    category_id: '',
                    frequency_id: '',
                    start_date: '',
                    event_date: '',
                    lead_time: '',
                },
                activityForm: {
                    description: '',
                    status: '',
                },
                eventTeamMemberForm: {
                    user_id: '',
                    is_owner: '',
                    designation: '',
                }
            }
        }

    },
    mounted() {
        this.form.eventForm.name = '',
        this.form.eventForm.venue = '',
        this.form.eventForm.category_id = '',
        this.form.eventForm.frequency_id = '',
        this.form.eventForm.start_date = '',
        this.form.eventForm.event_date = '',
        this.form.activityForm.description = '',
        this.form.activityForm.status = '',
        this.form.eventTeamMemberForm.user_id = '',
        this.form.eventTeamMemberForm.is_owner = '',
        this.form.eventTeamMemberForm.desgnation = ''
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
            this.isEditEvent = true;
            this.isShowAddEventForm = true;
            this.showEvents = false;
            this.form = event;
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
                    axios.delete('event/' + event.id).then((response) => {
                        if (response.status === 200) {
                            this.events = this.events.filter(response => response.id !== event.id)
                            Swal.fire('Deleted!', 'Event has been deleted.', 'success')
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    }).catch((error) => {
                        console.log('An error occured');
                    })
                }
            })
        },
    }
}
</script>

<style scoped>

</style>

