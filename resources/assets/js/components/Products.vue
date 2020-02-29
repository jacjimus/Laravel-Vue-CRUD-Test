<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Products</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#prod-modal">
                                Add New product
                                <i class="fas fa-shopping-cart fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th></th>

                            </tr>
                            <tr v-for="(prod, index) in products" :key="prod.id">
                                <td>{{prod.id}}</td>
                                <td>{{prod.name}}</td>
                                <td>{{prod.description}}</td>
                                <td>{{prod.quantity}}</td>

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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal -->
        <div
                class="modal fade"
                id="prod-modal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New prod</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="formSubmit" id="frm-prod">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name"  placeholder="Name" type="text"  name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" />
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.description"  placeholder="Description" name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.quantity"  placeholder="Quantity" type="number"  name="quantity" class="form-control" :class="{ 'is-invalid': form.errors.has('quantity') }" />
                                <has-error :form="form" field="quantity"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                form : new Form({
                    name: '',
                    description: '',
                    quantity: '',

                }),
                products: [],
                errors: [],
                editMode : false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchProducts();
            Fire.$on('NeedRefresh' , ()=>{this.fetchProducts()});
        },

        methods: {
            fetchProducts(){
               axios.get('api/products/')
                    .then(({data}) =>(this.products = data.data ))
            },

            initCreate()
            {
                this.editMode = false;
                this.form.reset();
                $("#prod-modal").modal("show");


            },
            initUpdate(prod)
            {
                 this.editMode = true;
                $("#prod-modal").modal("show");
                this.form.fill(prod);


            },

            formSubmit()
            {

                let myform  = document.getElementById('frm-prod');
                var mydata = new FormData(myform);


                this.form.post('api/products/save', mydata)
                    .then(response => {

                        Fire.$emit("NeedRefresh");
                        toast.fire({
                            type: 'success',
                            title: 'Product created!'
                        })
                        $("#prod-modal").modal("hide");


                    })

            },

            prodDelete(id) {
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/products/del/' + id).then(() => {

                            Fire.$emit('NeedRefresh');
                            toast.fire({
                                    type: 'success',
                                    title: 'Product deleted successfully'
                                }
                            )

                        });
                    }


                })
            }
        }

    }
</script>
