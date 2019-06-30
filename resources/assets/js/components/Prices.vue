<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Room Prices </h3>

                        <div class="card-tools">
                            <button @click="initCreate()" class="btn btn-success" >
                                Add New
                                <i class="fas fa-home fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <th>Hotel</th>
                            <th>Room type</th>
                            <th>Season</th>
                            <th>Cost (USD)</th>
                            </thead>
                            <tbody>
                            <tr v-for="(price, index) in prices" v-bind:key="price.id">

                                <td >{{price.hotel_name}}</td>
                                <td >{{price.room_type}}</td>
                                <td >{{price.season }}</td>
                                <td >{{price.cost}}</td>
                                <td >
                                    <a  href="#"
                                        @click="initUpdate(index)"><i class="fa fa-edit blue"></i> </a> |
                                    <a href="#"
                                       @click="priceDelete(price)"><i class="fa fa-trash red"></i></a>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>



        <!-- Create Modal Form -->
        <div class="modal fade" tabindex="-1" role="dialog" id="create-price-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add price</h4>
                        <button price="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form" id="create-price"  @submit="formSubmit">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group">
                                <label for="hotel_id">Hotel:</label>
                                <select v-model="price.hotel_id" name="hotel_id" id="hotel_id"  class="browser-default custom-select" tabindex="2">

                                    <option v-for="(hotel, index) in hotels" :key="index" :value="hotel.id">{{ hotel.hotel_name }}</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="hotel_id">Room type:</label>
                                <select v-model="price.room_type_id" name="room_type_id" id="room_type_id"  class="browser-default custom-select" tabindex="2">

                                    <option v-for="(type, index) in types" :key="index" :value="type.id">{{ type.room_type }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="season_id">Season:</label>
                                <select v-model="price.season_id" name="season_id" id="season_id"  class="browser-default custom-select" tabindex="2">

                                    <option v-for="(season, index) in seasons" :key="index" :value="season.id">{{ season.name }}</option>

                                </select>
                            </div>
                            <div class="form-group">
                                   <label for="cost">Price:</label>
                                    <input type="number" class="form-control" id="cost" name="cost"
                                           v-model= "price.cost" />


                            </div>


                            <div class="modal-footer">
                                <button price="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button price="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Edit modal Form starts here -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-price-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Room price</h4>
                        <button price="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form" id="edit-form"  @submit="formEditSubmit">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group">
                                <label for="hotel_id">Hotel:</label>
                                <select v-model="price.hotel_id" name="hotel_id" id="hotel_id"  class="browser-default custom-select" tabindex="2">

                                    <option v-for="(hotel, index) in hotels" :key="index" :value="hotel.id">{{ hotel.hotel_name }}</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="hotel_id">Room type:</label>
                                <select v-model="price.room_type_id" name="room_type_id" id="room_type_id"  class="browser-default custom-select" tabindex="2">

                                    <option v-for="(type, index) in types" :key="index" :value="type.id">{{ type.room_type }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="season_id">Season:</label>
                                <select v-model="price.season_id" name="season_id" id="season_id"  class="browser-default custom-select" tabindex="2">

                                    <option v-for="(season, index) in seasons" :key="index" :value="season.id">{{ season.name }}</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cost">Price:</label>
                                <input type="number" class="form-control" id="cost" name="cost"
                                       v-model= "price.cost" />


                            </div>


                            <div class="modal-footer">
                                <button price="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button price="submit" class="btn btn-primary">Submit</button>
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
                prices: [],
                hotels: [],
                types: [],
                seasons: [],
                errors: [],
                price : {
                    id: '',
                    hotel_id: '',
                    room_type_id: '',
                    seasons_id: '',
                    cost: '',
                },
                price_id : '',
                edit : false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchPrices();
            this.fetchHotels();
            this.fetchRoomTypes();
            this.fetchSeasons();
        },
        methods: {
            fetchPrices(){
                axios.get('api/prices/')
                    .then(({data}) => ( this.prices = data) )


            },
            fetchHotels(){
                axios.get('api/hotels/')
                    .then(({data}) => ( this.hotels = data) )
            },
            fetchRoomTypes(){
                axios.get('api/types/')
                    .then(({data}) => ( this.types = data) )
            },
            fetchSeasons(){
                axios.get('api/seasons/')
                    .then(({data}) => ( this.seasons = data) )

                },



            initCreate()
            {
                this.errors = [];
                this.price = [];
                $('#create-form').trigger('reset');
                $("#create-price-model").modal("show");


            },
            initUpdate(index)
            {
                this.errors = [];
                this.edit = true;
                $("#edit-price-model").modal("show");
                this.price = this.prices[index];


            },

            formSubmit(e)
            {
                e.preventDefault();


                let form  = document.getElementById('create-price');
                var mydata = new FormData(form);
                // var form_data = $('form#create-price').serializeArray();
                //

                axios.post('api/prices/save', mydata)
                    .then(response => {

                        $("#create-price-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for hotel
                        if (error.response.data.errors.hotel_id) {
                            this.errors.push(error.response.data.errors.hotel_id[0]);
                        }
                        // validation for cost
                        if (error.response.data.errors.cost) {
                            this.errors.push(error.response.data.errors.cost[0]);
                        }
                        // validation for season_id
                        if (error.response.data.errors.season_id) {
                            this.errors.push(error.response.data.errors.season_id[0]);
                        }
                        // validation for room_type_id
                        if (error.response.data.errors.room_type_id) {
                            this.errors.push(error.response.data.errors.room_type_id[0]);
                        }



                    });
            },
            formEditSubmit(e)
            {
                e.preventDefault();


                /*
                *Converting form to accept files
                 */


                let form  = document.getElementById('edit-form');
                var mydata = new FormData(form);


                mydata.append('id' , this.price.id);
                /*
                (Update) to the PUT route of the Laravel API
                 */

                axios.put('api/prices/edit', mydata)
                    .then(response => {

                        $("#edit-price-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for price price
                        if (error.response.data.errors.hotel_id) {
                            this.errors.push(error.response.data.errors.hotel_id[0]);
                        }
                        // validation for cost
                        if (error.response.data.errors.cost) {
                            this.errors.push(error.response.data.errors.cost[0]);
                        }
                        // validation for season_id
                        if (error.response.data.errors.season_id) {
                            this.errors.push(error.response.data.errors.season_id[0]);
                        }
                        // validation for room_type_id
                        if (error.response.data.errors.room_type_id) {
                            this.errors.push(error.response.data.errors.room_type_id[0]);
                        }


                    });
            },
            priceDelete(index){
                if(confirm("Do you want to remove this  price? ")){

                    axios.delete('api/prices/del/'+ index.id)
                        .then(response => {


                        })
                        .catch(error => {


                        });
                }

            }
        }

    }
</script>
