<template>
    <form class=" md:container md:mx-auto md:w-full sm:w-full" action="#">

        <br>
        <h1>EVENT DETAILS</h1>
        <br>
        <hr>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">
                <h1>Event Name</h1>
                <h2>{{event[0].name}}</h2>
            </div>

            <div class="sm:w-full md:w-1/2 ">

                <h1>Event Venue</h1>
               <h2>{{event[0].venue}}</h2>
            </div>
        </div>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">
                <h1>Event Category</h1>
               <h2>{{event[0].category.name}}</h2>
            </div>

            <div class="sm:w-full md:w-1/2 ">
                <h1>Event Frequency</h1>
               <h2>{{event[0].frequency.name}}</h2>
            </div>
        </div>
        <div class="md:flex">
            <div class="sm:w-full md:w-1/2 ">

                <h1>Add Department(s)</h1>
                <h2>{{event[0].department_id}}</h2>
            </div>

            <div class="sm:w-full md:w-1/2 ">
                <h1>Event Date</h1>
                <h2>{{event[0].event_date}}</h2>
            </div>
        </div>

        <div class="flex">
            <div class="sm:w-full md:w-1/2 ">
                <h1>Lead Date</h1>
                <h2>{{event[0].lead_time}}</h2>
            </div>
        </div>

        <br>
        <h1>EVENT ACTIVITIES</h1>
        <br>
        <hr>

        <table>
            <tr>
                <th>Activity</th>
                <th>Status</th>
                <th>Action</th>

                    <tr v-for="(activity, index) in event[0].activities">
                        <td>{{ activity.description }}</td>
                        <td>{{ activity.status }}</td>
                        <td><button class="bg-green-400 text-white text-bold px-2 py-1">Complete</button></td>
                    </tr>

                </table>


        <br>
        <h1>EVENT TEAM MEMBERS</h1>
        <br>
        <hr>

        <div class="flex">

            <table>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                </tr>
                <tr v-for="(teamMember, index) in event[0].team_members">
                    <td>{{ teamMember.user.first_name }}</td>
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
export default {
    name: "showEvent",
    props: ['event'],

    beforeMount() {
        console.log(this.event);
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
h1{
    color:gray;
    font-weight: bold;
    font-size: 20px;
}
h2{
    color:black;
    font-weight: bold;
    font-size: 18px;
    margin-bottom:10px;
}
</style>



