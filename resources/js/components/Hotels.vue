<template>
    <div class="container">
        <h2>Hotels</h2>
        <div class="card card-body" v-for="hotel in hotels" v-bind:key="hotel.id">
            <div class="row">
            <h3>{{hotel.name}}</h3>
            </div>
            <div class="row">
            <div class="col-md-6">
                <p>
                {{hotel.address}} <br>
            <span>{{hotel.country}}</span><br />
            <span>{{hotel.city}}</span><br />
            <span>{{hotel.state}}</span><br />
            <span>{{hotel.zip}}</span><br />
            <code>{{hotel.phone_number}}</code><br />
                </p>
        </div>
            <div class="col-md-6">
                <img :src= imageUrl @error="imgUrlAlt">
            </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                hotels: [],
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
                edit : false,
                imageUrl : ''
            }
        },
        created(){
            this.fetchHotels();
        },
        methods: {
            fetchHotels(){
                fetch('api/hotels')
                    .then(res => res.json())
                    .then(res => {
                        this.hotels = res.data
                        this.imageUrl =   "../../images/" + res.data[0].image
                    })
            }
        }
    }
</script>
