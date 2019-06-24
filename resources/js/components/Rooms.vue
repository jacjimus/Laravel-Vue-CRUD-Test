<template>
    <div class="container">
        <h2>Hotel Rooms</h2>
        <div class="card card-body mb-2" v-for="(room, index) in rooms" v-bind:key="room.id">
            <div class="row">
                <div class="col-md-10"><h3>{{room.name}}</h3>  </div>
                <div class="pull-right col-md-2">
                    <a class="dropdown-item text-primary" href="#"
                       @click="initUpdate(index)">Edit room</a>


                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        {{room.address}} <br>
                        <span>{{room.country}}</span><br />
                        <span>{{room.city}}</span><br />
                        <span>{{room.state}}</span><br />
                        <span>{{room.zip}}</span><br />
                        <code>{{room.email}}</code><br />
                        <code>{{room.phone_number}}</code><br />
                    </p>
                </div>
                <div class="col-md-6">
                    <img :src= "`${room.image.replace('public' , '')}`"  height="200px" width="250px" @error="">
                </div>
            </div>


        </div>

        <!-- Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update-room-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Hotel details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name"
                                           v-model= "update_room.name">
                                </div>
                                <div class="col-md-6">
                                    <label for="address">Address:</label>
                                    <input type="text" placeholder="Address" class="form-control"  id="address"
                                           v-model="update_room.address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="country">Country:</label>
                                    <input type="text" placeholder="Country" class="form-control" id="country"
                                           v-model="update_room.country">
                                </div>
                                <div class="col-md-6">
                                    <label for="city">City:</label>
                                    <input type="text" placeholder="City" class="form-control" id="city"
                                           v-model="update_room.city">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="state">State:</label>
                                    <input type="text" placeholder="State" class="form-control" id="state"
                                           v-model="update_room.state">
                                </div>
                                <div class="col-md-6">
                                    <label for="zip">Zip:</label>
                                    <input type="text" placeholder="Zip" class="form-control" id="zip"
                                           v-model="update_room.zip">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="phone_number">Phone number:</label>
                                    <input type="text" placeholder="phone_number" class="form-control" id="phone_number"
                                           v-model="update_room.phone_number">
                                </div>
                                <div class="col-md-6">
                                    <label for="image">Image:</label>
                                    <input type="text" class="form-control" id="image"
                                           v-model="update_room.image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="text" placeholder="email" class="form-control" id="email"
                                           v-model="update_room.email">
                                </div>
                                <div class="col-md-6">
                                    <label for="address">Image:</label>
                                    <input type="text" class="form-control"
                                           v-model="update_room.image">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateHotel" class="btn btn-primary">Submit</button>
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
                rooms: [],
                errors: [],
                update_room : {},
                room : {
                    id: '',
                    name: '',
                    address : '',
                    city : '',
                    state : '',
                    country : '',
                    zip : '',
                    phone_number : '',
                    email : '',
                    image : '',
                    status : ''
                },
                room_id : '',
                name : '',
                edit : false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchHotels();
        },
        methods: {
            fetchHotels(){
                fetch('api/rooms/')
                    .then(res => res.json())
                    .then(res => {
                        this.rooms = res.data

                    })
            },
            initUpdate(index)
            {
                this.errors = [];
                $("#update-room-model").modal("show");
                this.update_room = this.rooms[index];


            },
            updateHotel()
            {
                axios.put('api/rooms/update', {
                    room_id: this.update_room.id,
                    name: this.update_room.name,
                    address: this.update_room.address,
                    country: this.update_room.country,
                    city: this.update_room.city,
                    state: this.update_room.address,
                    zip: this.update_room.zip,
                    phone_number: this.update_room.phone_number,
                    email: this.update_room.email,
                    image: this.update_room.image,
                })
                    .then(response => {

                        $("#update-room-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for name
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
                        // validation for address
                        if (error.response.data.errors.address) {
                            this.errors.push(error.response.data.errors.address[0]);
                        }
                        // validation for country
                        if (error.response.data.errors.country) {
                            this.errors.push(error.response.data.errors.country[0]);
                        }
                        // validation for city
                        if (error.response.data.errors.city) {
                            this.errors.push(error.response.data.errors.city[0]);
                        }
                        // validation for state
                        if (error.response.data.errors.state) {
                            this.errors.push(error.response.data.errors.state[0]);
                        }
                        // validation for zip
                        if (error.response.data.errors.zip) {
                            this.errors.push(error.response.data.errors.zip[0]);
                        }
                        // validation for phone_number
                        if (error.response.data.errors.phone_number) {
                            this.errors.push(error.response.data.errors.phone_number[0]);
                        }
                        // validation for email
                        if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }

                    });
            },
        }

    }
</script>
