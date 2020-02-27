
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Suppliers Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#supplier-form">
                                Add New Supplier
                                <i class="fas fa-user-plus fa-fw"></i>
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
                                <th>Date Joined</th>
                                <th>#</th>

                            </tr>
                            <tr v-for="(supplier, index) in suppliers" :key="supplier.id">
                                <td>{{supplier.id}}</td>
                                <td>{{supplier.name}}</td>
                                <td>{{supplier.created_at}}</td>

                                <td>

                                    <a href="javascript:void(0)"  @click="viewProducts(supplier.id)">
                                        <i class="fa fa-eye green"></i>
                                    </a>&nbsp;|&nbsp;
                                    <a href="javascript:void(0)"  @click="initUpdate(supplier)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>&nbsp;|&nbsp;
                                    <a href="javascript:void(0)"  @click="delSupplier(supplier.id)">
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
                id="supplier-form"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="formSubmit" id="frm-supplier">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name"  placeholder="Name" type="text"  name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" />
                                <has-error :form="form" field="name"></has-error>
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
                suppliers: {},
                form : new Form({
                    id: '',
                    name: '',
                    created_at: '',

                }),

                edit : true,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchSuppliers();
            Fire.$on('NeedRefresh', () => {this.fetchSuppliers()});
        },
        methods: {
            fetchSuppliers(){
                axios.get('api/suppliers/')
                    .then(({data}) => ( this.suppliers = data.data) )
            },
            initUpdate(supplier)
            {
                this.form.reset();
                $("#supplier-form").modal("show");
               this.form.fill(supplier);


            },
            formSubmit()
            {


                let myform  = document.getElementById('frm-supplier');
                var mydata = new FormData(myform);

                this.form.post('api/suppliers/save', mydata)
                        .then(response => {

                            Fire.$emit("NeedRefresh");
                            toast.fire({
                                type: 'success',
                                title: 'Supplier added!'
                            })
                            $("#supplier-form").modal("hide");


                        })

            },
            updateSupplier()
            {
                let myform  = document.getElementById('supplier-form');
                var mydata = new FormData(myform);


                mydata.append('id' , this.form.id);
                this.form.put('api/suppliers/update', {

                })
                    .then(response => {

                        Fire.$emit('NeedRefresh');
                        $("#update-supplier-model").modal("hide");
                        toast.fire({
                            type: 'success',
                            title: 'Supplier updated successfully'
                        })

                    })

            },
            delSupplier(id) {

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
                        this.form.delete('api/suppliers/del/' + id).then(() => {

                            Fire.$emit('NeedRefresh');
                            toast.fire({
                                        type: 'success',
                                        title: 'Supplier deleted successfully'
                                    }
                            )

                        });
                    }


                })
            }


        }

    }
</script>
