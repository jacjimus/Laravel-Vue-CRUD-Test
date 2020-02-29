<template>
    <div class="container">
        <h2>Orders</h2>
        <div class="card card-body mb-2" v-for="(order, index) in orders" :key="order.id" v-model.total="form.total =0" >
            <div class="row">
                <div class="col-md-10"><h3>Order number: {{order.order_number}}</h3>  </div>
                <div class="pull-right col-md-2">
                    <a class="dropdown-item text-primary" href="#"
                       @click="initUpdate(index)"><i class="fa fa-edit blue"></i></a>


                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Order: Details:
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th>Product code</th>
                            <th>Product name</th>
                            <th>Quantity</th>
                            <th>Amount</th>


                        </tr>
                        <tr v-for="(prod, index) in order.details" :key="prod.id" v-model.total="form.total = prod.quantity * prod.product.amount" >
                            <td>{{prod.id}}</td>
                            <td>{{prod.product.name}}</td>
                            <td>{{prod.quantity}}</td>
                            <td>{{prod.product.amount}}</td>

                            <td>


                                <a href="javascript:void(0)"  @click="initUpdate(prod)">
                                    <i class="fa fa-edit blue"></i>
                                </a>&nbsp;|&nbsp;
                                <a href="javascript:void(0)"  @click="prodDelete(prod.id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="pull-right col-md-6 text-bold">
                    Order Total: {{form.total}}
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="update-order-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update order details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">


                        <form class="form" id="order-form" @submit.prevent="editorder()">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="order_number">Name:</label>
                                    <input type="text" class="form-control" id="order_number"  :class="{ 'is-invalid': form.errors.has('order_number') }"
                                           v-model= "form.order_number">
                                    <has-error :form="form" field="order_number"></has-error>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateorder()" class="btn btn-primary">Submit</button>
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
                orders: {},
                form : new Form({
                    id: '',
                    order_number: '',
                    details: '',
                    product: '',
                    total: 0,
                   }),

                edit : true,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },

        created(){
            this.fetchOrders();
            Fire.$on('AfterCreate', () => {this.fetchOrders()});
        },

        methods: {
            fetchOrders(){
                axios.get('api/orders')
                        .then(({data}) => ( this.orders = data.data) )
            },
            initUpdate(order)
            {
                this.form.reset();
                $("#update-order-model").modal("show");
                this.form.fill(order);


            },
            updateOrder()
            {
                let myform  = document.getElementById('order-form');
                var mydata = new FormData(myform);


                mydata.append('id' , this.form.id);
                this.form.put('api/orders/update', {

                })
                        .then(response => {

                            Fire.$emit('AfterCreate');
                            $("#update-order-model").modal("hide");
                            toast.fire({
                                type: 'success',
                                title: 'Order updated successfully'
                            })

                        })

            },


        }

    }
</script>
