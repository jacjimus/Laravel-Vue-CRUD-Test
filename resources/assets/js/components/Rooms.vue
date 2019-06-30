<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10"><h2>Hotel Rooms</h2></div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-success" href="#"
                   @click="initCreate()">Add a room</a>
            </div>
        </div>

        <div class="card card-body mb-2" v-for="(room, index) in rooms" v-bind:key="room.id">
            <div class="row">
                <div class="col-md-10"><h3>{{room.room_name}}</h3>  </div>
                <div class="pull-right col-md-2">
                    <a class="dropdown-item text-primary" href="#"
                       @click="initUpdate(index)">Edit room</a> <br />
                    <a class="dropdown-item text-danger" href="#"
                       @click="roomDelete(room)">Delete room</a>


                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>
                         <br>
                        Hotel: <span>{{room.hotel_name}}</span><br />
                        Capacity: <span>{{room.room_capacity}}</span><br />
                        Room Type: <span>{{room.room_type}}</span><br />

                    </p>
                </div>
                <div class="col-md-6">
                    <img :src= "`../../images/rooms/${room.room_image}`"  height="200px" width="250px" >
                </div>
            </div>


        </div>

        <!-- Create Modal Form -->
        <div class="modal fade" tabindex="-1" role="dialog" id="create-room-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Hotel room</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">


                        <form class="form" id="create-room" @submit.prevent="formSubmit" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_name">Room Name:</label>
                                    <input type="text" class="form-control" id="room_name" name="room_name"
                                           v-model= "form.room_name" :class="{ 'is-invalid': form.errors.has('room_name') }" />
                                    <has-error :form="form" field="room_name"></has-error>
                                </div>
                                <div class="col-md-6">
                                    <label for="hotel_id">Hotel:</label>
                                    <select v-model="form.hotel_id" name="hotel_id" id="hotel_id" class="browser-default custom-select" :class="{ 'is-invalid': form.errors.has('hotel_id') }"  tabindex="2">

                                        <option v-for="(hotel, index) in hotels" :key="index" :value="hotel.id">{{ hotel.hotel_name }}</option>

                                    </select>
                                    <has-error :form="form" field="hotel_id"></has-error>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type_id">Type:</label>
                                    <select v-model="form.room_type_id" id="room_type_id" name="room_type_id" class="browser-default custom-select" :class="{ 'is-invalid': form.errors.has('room_type_id') }" tabindex="2">

                                        <option v-for="(type, index) in room_types" :key="index" :value="type.id">{{ type.room_type }}</option>

                                    </select>
                                    <has-error :form="form" field="room_type_id"></has-error>
                                </div>
                                <div class="col-md-6">
                                    <label for="room_capacity_id">Capacity:</label>
                                    <select v-model="form.room_capacity_id" id="room_capacity_id" name="room_capacity_id"  class="browser-default custom-select" :class="{ 'is-invalid': form.errors.has('room_capacity_id') }" tabindex="2">

                                        <option v-for="(capacity, index) in room_capacities" :key="index" :value="capacity.id">{{ capacity.room_capacity }}</option>

                                    </select>
                                    <has-error :form="form" field="room_capacity_id"></has-error>
                                </div>
                                <div class="col-md-8">
                                    <label for="room_image">Image:</label>
                                    <input type="file" class="form-control" id="room_image" name="room_image" :class="{ 'is-invalid': form.errors.has('room_image') }"
                                           v-on:change="onImageChange">
                                    <has-error :form="form" field="room_image"></has-error>
                                </div>
                            </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>
</template>
<script>
    export default{
        data(){
            return {
                form : new Form({
                    room_name: '',
                    hotel_id: '',
                    room_type_id: '',
                    room_capacity_id: '',
                }),
                rooms: [],
                hotels: [],
                room_types: [],
                room_capacities: [],
                errors: [],
                update_room : {},
                room_id : '',
                image : '',
                edit : false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchHotels();
            this.fetchRooms();
            this.fetchRoomTypes();
            this.fetchRoomcapacity();
        },
        mounted() {
            console.log('Component mounted')
            this.fetchRooms();
        },
        methods: {
            fetchHotels(){
               axios.get('api/hotels/')
                    .then(({data}) =>(this.hotels = data.data ))
            },
            fetchRooms(){
                axios.get('api/rooms/')
                    .then(({data}) => ( this.rooms = data.data) )

            },
            fetchRoomTypes(){
                axios.get('api/types')
                    .then(({data}) => ( this.room_types = data.data) )

                   },
            fetchRoomcapacity(){
                axios.get('api/capacity')
                    .then(({data}) => ( this.room_capacities = data.data) )

            },
            initCreate()
            {
                this.form.reset();
                this.form.errors.clear();
                $('#create-form').trigger('reset');
                $("#create-room-model").modal("show");


            },
            initUpdate(index)
            {
                this.errors = [];
                this.edit = true;
                $("#edit-room-model").modal("show");
                this.room = this.rooms[index];


            },
            onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
            },
            formSubmit(e)
            {
                e.preventDefault();
               /*
               *Converting form to accept files
                */
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }


                let form  = document.getElementById('create-room');
                var mydata = new FormData(form);

                mydata.append('room_image' , this.image);

                this.form.post('api/rooms/save', mydata, config)
                    .then(response => {

                        $("#create-room-model").modal("hide");

                    })

            },
            formEditSubmit(e)
            {
                e.preventDefault();


                /*
                *Converting form to accept files
                 */
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }


                let myform  = document.getElementById('edit-room');
                var mydata = new FormData(myform);

                // var form_data = $('form#create-room').serializeArray();
                //


                 mydata.append('room_image' , this.image);
                 mydata.append('id' , this.room.id);
                /*
                (Update) to the PUT route of the Laravel API
                 */

                axios.put('api/rooms/edit', mydata, config)
                    .then(response => {

                        $("#edit-room-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for room name
                        if (error.response.data.errors.room_name) {
                            this.errors.push(error.response.data.errors.room_name[0]);
                        }
                        // validation for hotel id
                        if (error.response.data.errors.hotel_id) {
                            this.errors.push(error.response.data.errors.hotel_id[0]);
                        }
                        // validation for room_type id
                        if (error.response.data.errors.room_type_id) {
                            this.errors.push(error.response.data.errors.room_type_id[0]);
                        }
                        // validation for room_capacity id
                        if (error.response.data.errors.room_capacity_id) {
                            this.errors.push(error.response.data.errors.room_capacity_id[0]);
                        }

                    });
            },
            roomDelete(index){
                if(confirm("Do you want to remove this room? ")){

                    axios.delete('api/rooms/del/'+ index.id)
                        .then(response => {


                        })
                        .catch(error => {


                        });
                }

            }
        }

    }
</script>
