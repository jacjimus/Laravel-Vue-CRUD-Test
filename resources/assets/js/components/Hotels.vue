<template>
    <div class="container">
        <h2>Hotels</h2>
        <div class="card card-body mb-2" v-for="hotel in hotels" :key="hotel.id">
                     <div class="row">
                        <div class="col-md-10"><h3>{{hotel.hotel_name}}</h3>  </div>
                        <div class="pull-right col-md-2">
                        <a class="dropdown-item text-primary" href="#"
                               @click="initUpdate(index)"><i class="fa fa-edit blue"></i></a>


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
                    <img :src= "`${hotel.image.replace('public', '')}`"  height="200px" width="250px" @error="">
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


                            <form class="form" @submit.prevent="editHotel">
                                <input type="hidden" id="_token" :value="csrf">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="hotel_name">Name:</label>
                                <input type="text" class="form-control" id="hotel_name"  :class="{ 'is-invalid': form.errors.has('hotel_name') }"
                                       v-model= "form.hotel_name">
                                <has-error :form="form" field="hotel_name"></has-error>
                            </div>
                            <div class="col-md-6">
                                <label for="address">Address:</label>
                                <input type="text" placeholder="Address" class="form-control"  id="address" :class="{ 'is-invalid': form.errors.has('address') }"
                                       v-model="form.address">
                                <has-error :form="form" field="address"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="country">Country:</label>
                                <input type="text" placeholder="Country" class="form-control" id="country" :class="{ 'is-invalid': form.errors.has('country') }"
                                       v-model="form.country">
                                <has-error :form="form" field="country"></has-error>
                            </div>
                            <div class="col-md-6">
                                <label for="city">City:</label>
                                <input type="text" placeholder="City" class="form-control" id="city" :class="{ 'is-invalid': form.errors.has('city') }"
                                       v-model="form.city">
                                <has-error :form="form" field="city"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="state">State:</label>
                                <input type="text" placeholder="State" class="form-control" id="state" :class="{ 'is-invalid': form.errors.has('state') }"
                                       v-model="form.state">
                                <has-error :form="form" field="state"></has-error>
                            </div>
                            <div class="col-md-6">
                                <label for="zip">Zip:</label>
                                <input type="text" placeholder="Zip" class="form-control" id="zip" :class="{ 'is-invalid': form.errors.has('zip') }"
                                       v-model="form.zip">
                                <has-error :form="form" field="zip"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="phone_number">Phone number:</label>
                                <input type="text" placeholder="phone_number" class="form-control" id="phone_number" :class="{ 'is-invalid': form.errors.has('phone_number') }"
                                       v-model="form.phone_number">
                                <has-error :form="form" field="phone_number"></has-error>
                            </div>
                            <div class="col-md-6">
                                <label for="image">Image:</label>
                                <input type="text" class="form-control" id="image" :class="{ 'is-invalid': form.errors.has('image') }"
                                       v-model="form.image">
                                <has-error :form="form" field="image"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                                <label for="email">Email:</label>
                                <input type="email" placeholder="email" class="form-control" id="email" :class="{ 'is-invalid': form.errors.has('email') }"
                                       v-model="form.email">
                                <has-error :form="form" field="email"></has-error>
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
                hotels: {},
                form : new Form({
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
                }),
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
                axios.get('api/hotels')
                    .then(({data}) => ( this.hotels = data.data) )
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
                    name: this.update_hotel.hotel_name,
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

            },


        }

    }
</script>
