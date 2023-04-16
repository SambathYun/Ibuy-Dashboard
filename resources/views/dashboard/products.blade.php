@extends('layouts.app')

@section('content')
    {{-- <div class="row p-0">
        <div class="row p-0">
            <div class="float-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modalId"
                    id="addButton" onclick="addProduct()">
                    <span class="px-3"> Add</span>
                </button>
                <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#modalId"
                    id="editButton" onclick="editProduct()">
                    <span class="px-3"> Edit</span>
                </button>
                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#modalId"
                    id="editButton" onclick="editProduct()">
                    <span class="px-3"> Delete</span>
                </button>

                @if (Session::has('msg'))
                    <div class="alert alert-success" role="alert">
                        {{ Session('msg') }}
                    </div>
                @endif

                <!-- Modal add-->
                <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                    aria-hidden="true">

                    <div class="modal-dialog" role="document">
                        <form action="{{ Route('product.update') }}" method="POST" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">

                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder="id" name='id'
                                                id="productId">
                                            <label for="floatingInput">id</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder="title" name='title'
                                                id="productName">
                                            <label for="floatingInput">Tittle</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="price" step="any" name='price'>
                                            <label for="floatingInput">Price</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="discount" step="any" name='discount'>
                                            <label for="floatingInput">Discount</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name='des'></textarea>
                                            <label for="floatingTextarea">Description</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="floatingSelect"
                                                aria-label="Floating label select location" name='type'>
                                                {{-- <option selected>type</option> --
                                                <option value="1">Shirt</option>
                                                <option value="2">Bag</option>
                                                <option value="3">Shoes</option>
                                            </select>
                                            <label for="floatingSelect">Select</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="file" name="image" accept="image/png, image/gif, image/jpeg">
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        @foreach ($values as $value)
            <div class="card mt-2" style="width: 18rem;"
                onclick="idProduct('{{ $value->id }}' , '{{ $value->title }}')">
                <img src="/photo/{{ $value->image }}" class="card-img-top" alt="product-image"
                    style="max-width: 100%; max-height: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $value->title }}</h5>
                    <p class="card-text">{{ $value->description }}</p>
                    <a href="#" class="btn btn-primary">{{ $value->price }}</a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Js  --

    <script type="text/javascript">
        var modalId = document.getElementById('modalId');


        modalId.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let recipient = button.getAttribute('data-bs-whatever');
            // Use above variables to manipulate the DOM
        });

        function idProduct(id, title) {
            // localStorage.setItem("mytime", name);
            $('#productId').val(id);
            $('#productName').val(title);
        }

        function addProduct() {
            $('#modalTitleId').text('Add Product');

        };

        function editProduct() {
            var title = localStorage.getItem('mytime');
            $('#modalTitleId').text('Edit Product');

        }
    </script> --}}
    <div>


        <div class="box-header">
            <h3 class="box-title">Pick Mood</h3>
            {{-- <div class="box-tools">
                <button type="button" class="btn btn-block btn-primary btn-modal"
                    data-href="{{ action('PickMoodController@create') }}" data-container=".pick_mood_modal">
                    <i class="fa fa-plus"></i> @lang('messages.add')</button>
            </div> --}}

        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="product_table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>@lang('messages.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {


            $('#product_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.all') }}",
                columns: [{
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


        });
    </Script>
@endsection
