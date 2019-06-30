<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Room Bookings</h3>

                        <div class="card-tools">
                            <button @click="initCreate()" class="btn btn-success" >
                                Add New
                                <i class="fas fa-home fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <div id="calendar" class="fc fc-unthemed fc-ltr"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"><div class="fc-button-group"><button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" aria-label="prev"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" aria-label="next"><span class="fc-icon fc-icon-right-single-arrow"></span></button></div><button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled" disabled="">today</button></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">week</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button></div></div><div class="fc-center"><h2>June 2019</h2></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style=""><table class=""><thead class="fc-head"><tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header"><table class=""><thead><tr><th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th><th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th><th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th><th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th><th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th><th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th><th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 658.2px;"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content" style="height: 109px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2019-05-26"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2019-05-27"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2019-05-28"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2019-05-29"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="2019-05-30"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-past" data-date="2019-05-31"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-06-01"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2019-05-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2019-05-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2019-05-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2019-05-29"><span class="fc-day-number">29</span></td><td class="fc-day-top fc-thu fc-other-month fc-past" data-date="2019-05-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-fri fc-other-month fc-past" data-date="2019-05-31"><span class="fc-day-number">31</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-06-01"><span class="fc-day-number">1</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#f56954;border-color:#f56954"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">All Day Event</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 109px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-06-02"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-06-03"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-06-04"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-06-05"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-06-06"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-06-07"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-06-08"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-06-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-06-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-06-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-06-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-06-06"><span class="fc-day-number">6</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-06-07"><span class="fc-day-number">7</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-06-08"><span class="fc-day-number">8</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 109px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-06-09"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-06-10"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-06-11"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-06-12"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-06-13"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-06-14"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-06-15"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-06-09"><span class="fc-day-number">9</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-06-10"><span class="fc-day-number">10</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-06-11"><span class="fc-day-number">11</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-06-12"><span class="fc-day-number">12</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-06-13"><span class="fc-day-number">13</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-06-14"><span class="fc-day-number">14</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-06-15"><span class="fc-day-number">15</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 109px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-06-16"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-06-17"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-06-18"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2019-06-19"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2019-06-20"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2019-06-21"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2019-06-22"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-06-16"><span class="fc-day-number">16</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-06-17"><span class="fc-day-number">17</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-06-18"><span class="fc-day-number">18</span></td><td class="fc-day-top fc-wed fc-past" data-date="2019-06-19"><span class="fc-day-number">19</span></td><td class="fc-day-top fc-thu fc-past" data-date="2019-06-20"><span class="fc-day-number">20</span></td><td class="fc-day-top fc-fri fc-past" data-date="2019-06-21"><span class="fc-day-number">21</span></td><td class="fc-day-top fc-sat fc-past" data-date="2019-06-22"><span class="fc-day-number">22</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container" colspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-not-end fc-draggable" style="background-color:#f39c12;border-color:#f39c12"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Long Event</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 108px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2019-06-23"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2019-06-24"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2019-06-25"></td><td class="fc-day fc-widget-content fc-wed fc-today " data-date="2019-06-26"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2019-06-27"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2019-06-28"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2019-06-29"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2019-06-23"><span class="fc-day-number">23</span></td><td class="fc-day-top fc-mon fc-past" data-date="2019-06-24"><span class="fc-day-number">24</span></td><td class="fc-day-top fc-tue fc-past" data-date="2019-06-25"><span class="fc-day-number">25</span></td><td class="fc-day-top fc-wed fc-today " data-date="2019-06-26"><span class="fc-day-number">26</span></td><td class="fc-day-top fc-thu fc-future" data-date="2019-06-27"><span class="fc-day-number">27</span></td><td class="fc-day-top fc-fri fc-future" data-date="2019-06-28"><span class="fc-day-number">28</span></td><td class="fc-day-top fc-sat fc-future" data-date="2019-06-29"><span class="fc-day-number">29</span></td></tr></thead><tbody><tr><td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-not-start fc-end fc-draggable" style="background-color:#f39c12;border-color:#f39c12"><div class="fc-content"> <span class="fc-title">Long Event</span></div></a></td><td rowspan="2"></td><td rowspan="2"></td><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#0073b7;border-color:#0073b7"><div class="fc-content"><span class="fc-time">10:30a</span> <span class="fc-title">Meeting</span></div></a></td><td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#00a65a;border-color:#00a65a"><div class="fc-content"><span class="fc-time">7p</span> <span class="fc-title">Birthday Party</span></div></a></td><td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" href="http://google.com/" style="background-color:#3c8dbc;border-color:#3c8dbc"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Click for Google</span></div></a></td><td rowspan="2"></td></tr><tr><td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#00c0ef;border-color:#00c0ef"><div class="fc-content"><span class="fc-time">12p</span> <span class="fc-title">Lunch</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 113px;"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2019-06-30"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2019-07-01"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2019-07-02"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2019-07-03"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2019-07-04"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2019-07-05"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2019-07-06"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2019-06-30"><span class="fc-day-number">30</span></td><td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2019-07-01"><span class="fc-day-number">1</span></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2019-07-02"><span class="fc-day-number">2</span></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2019-07-03"><span class="fc-day-number">3</span></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2019-07-04"><span class="fc-day-number">4</span></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2019-07-05"><span class="fc-day-number">5</span></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2019-07-06"><span class="fc-day-number">6</span></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


        <!-- Create Modal Form -->
        <div class="modal fade" tabindex="-1" role="dialog" id="create-type-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add room type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form" id="create-type"  @submit="formSubmit">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type">Room Type:</label>
                                    <input type="text" class="form-control" id="room_type" name="room_type"
                                           v-model= "type.room_type" />
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

        <!-- Edit modal Form starts here -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-type-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Room type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form" id="edit-type"  @submit="formEditSubmit" >
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type">Room Name:</label>
                                    <input type="text" class="form-control" name="room_type"
                                           v-model= "type.room_type" />
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
                types: [],
                errors: [],
                type : {
                    id: '',
                    room_type: '',
                },
                type_id : '',
                edit : false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchTypes();
        },
        methods: {
            fetchTypes(){
                axios.get('api/types/')
                    .then(({data}) => ( this.types = data) )


            },



            initCreate()
            {
                this.errors = [];
                this.type = [];
                $('#create-form').trigger('reset');
                $("#create-type-model").modal("show");


            },
            initUpdate(index)
            {
                this.errors = [];
                this.edit = true;
                $("#edit-type-model").modal("show");
                this.type = this.types[index];


            },

            formSubmit(e)
            {
                e.preventDefault();


                let form  = document.getElementById('create-type');
                var mydata = new FormData(form);
                // var form_data = $('form#create-type').serializeArray();
                //

                axios.post('api/types/save', mydata)
                    .then(response => {

                        $("#create-type-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for room type
                        if (error.response.data.errors.room_type) {
                            this.errors.push(error.response.data.errors.room_type[0]);
                        }


                    });
            },
            formEditSubmit(e)
            {
                e.preventDefault();


                /*
                *Converting form to accept files
                 */


                let form  = document.getElementById('edit-type');
                var mydata = new FormData(form);


                mydata.append('id' , this.type.id);
                /*
                (Update) to the PUT route of the Laravel API
                 */

                axios.put('api/types/edit', mydata)
                    .then(response => {

                        $("#edit-type-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for room type
                        if (error.response.data.errors.room_type) {
                            this.errors.push(error.response.data.errors.room_type[0]);
                        }


                    });
            },
            typeDelete(index){
                if(confirm("Do you want to remove this room type? ")){

                    axios.delete('api/types/del/'+ index.id)
                        .then(response => {


                        })
                        .catch(error => {


                        });
                }

            }
        }

    }
</script>
