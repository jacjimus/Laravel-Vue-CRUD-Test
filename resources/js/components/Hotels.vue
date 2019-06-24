<template>
    <div class="container">
        <h2>Hotels</h2>
        <div class="card card-body mb-2" v-for="(hotel, index) in hotels" v-bind:key="hotel.id">
            <div class="row">
            <div class="col-md-10"><h3>{{hotel.name}}</h3>  </div>
                <div class="pull-right col-md-2">
                    <a class="page-link text-success" :href="rooms">View hotel</a> |
                    <a class="dropdown-item text-primary" href="#"
                           @click="initUpdate(index)">Edit hotel</a>


                </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <p>
                {{hotel.address}} <br>
            <span>{{hotel.country}}</span><br />
            <span>{{hotel.city}}</span><br />
            <span>{{hotel.state}}</span><br />
            <span>{{hotel.zip}}</span><br />
            <code>{{hotel.email}}</code><br />
            <code>{{hotel.phone_number}}</code><br />
                </p>
        </div>
            <div class="col-md-6">
                <img :src= "`${hotel.image.replace('public' , '')}`"  height="200px" width="250px" @error="">
            </div>
            </div>


        </div>

        <!-- Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update-hotel-model">
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
                                       v-model= "update_hotel.name">
                            </div>
                            <div class="col-md-6">
                                <label for="address">Address:</label>
                                <input type="text" placeholder="Address" class="form-control"  id="address"
                                       v-model="update_hotel.address">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="country">Country:</label>
                                <input type="text" placeholder="Country" class="form-control" id="country"
                                       v-model="update_hotel.country">
                            </div>
                            <div class="col-md-6">
                                <label for="city">City:</label>
                                <input type="text" placeholder="City" class="form-control" id="city"
                                       v-model="update_hotel.city">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="state">State:</label>
                                <input type="text" placeholder="State" class="form-control" id="state"
                                       v-model="update_hotel.state">
                            </div>
                            <div class="col-md-6">
                                <label for="zip">Zip:</label>
                                <input type="text" placeholder="Zip" class="form-control" id="zip"
                                       v-model="update_hotel.zip">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="phone_number">Phone number:</label>
                                <input type="text" placeholder="phone_number" class="form-control" id="phone_number"
                                       v-model="update_hotel.phone_number">
                            </div>
                            <div class="col-md-6">
                                <label for="image">Image:</label>
                                <input type="text" class="form-control" id="image"
                                       v-model="update_hotel.image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email:</label>
                                <input type="text" placeholder="email" class="form-control" id="email"
                                       v-model="update_hotel.email">
                            </div>
                            <div class="col-md-6">
                                <label for="address">Image:</label>
                                <input type="text" class="form-control"
                                       v-model="update_hotel.image">
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
                hotels: [],
                errors: [],
                update_hotel : {},
                hotel : {
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
                hotel_id : '',
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
                fetch('api/hotels/')
                    .then(res => res.json())
                    .then(res => {
                        this.hotels = res.data

                    })
            },
            initUpdate(index)
            {
                this.errors = [];
                $("#update-hotel-model").modal("show");
               this.update_hotel = this.hotels[index];


            },
            updateHotel()
            {
                axios.put('api/hotels/update', {
                    hotel_id: this.update_hotel.id,
                    name: this.update_hotel.name,
                    address: this.update_hotel.address,
                    country: this.update_hotel.country,
                    city: this.update_hotel.city,
                    state: this.update_hotel.address,
                    zip: this.update_hotel.zip,
                    phone_number: this.update_hotel.phone_number,
                    email: this.update_hotel.email,
                    image: this.update_hotel.image,
                })
                    .then(response => {

                        $("#update-hotel-model").modal("hide");

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
