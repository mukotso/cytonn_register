<template>
    <div>
        <button v-if="showEvents"
                class="btn"
                type="button" @click="toggleAddEventForm">
            <i class="fa fa-plus "></i>New Event
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


        <div v-if="showEvents" class=" md:mx-20  p-4">
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
                    <td><div class="flex mt-2">
                        <button
                            class=" m-4 block text-white bg-green-400 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-3 text-center "
                            @click.prevent="showEvent(event)">
                            VIEW MORE
                        </button>

                        <button @click="editEvent(event)"
                                class="m-4 block text-white bg-blue-400 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-3 text-center"
                        >
                            EDIT
                        </button>

                        <button
                            class=" m-4 block text-white bg-red-700 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-3 text-center "
                            @click.prevent="deleteEvent(event)">
                            DELETE
                        </button>
                    </div></td>
                </tr>

            </table>

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
                    id:'',
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
    mounted() {
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
            window.location.href = "/event/"+event.id+"/edit";
        },

        showEvent(event) {
            window.location.href = "/event/"+event.id;
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

