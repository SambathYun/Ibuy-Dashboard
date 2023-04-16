@extends('layouts.app')

@section('content')
    <div class="row p-0">
        <div class="row p-0">
            <div class="float-right">
                <!-- Button trigger modal -->


                <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" id="addButton">
                    <span class="px-3"> Add</span>
                </button>

                {{--
                <div id="alert-successId" class="alert alert-success my-2" role="alert" style="display: none">
                    <span id="alert-suc-title"></span>
                </div> --}}


                <!-- Modal add-->
                <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                    aria-hidden="true">

                    <div class="modal-dialog" role="document">

                        <form id="reportForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">Create</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="col">
                                            <div id="alert-errorId" class="alert alert-danger" role="alert"
                                                style="display: none;">
                                                <span id="alert-err-title"></span>
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" placeholder="id" name='id'
                                                id="reportId">
                                            <label for="floatingInput">id</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="rtitle" placeholder="title"
                                                name='title'>
                                            <label for="floatingInput">Tittle</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="rprice" placeholder="price"
                                                step="any" name='price'>
                                            <label for="floatingInput">Price</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="rqty" placeholder="price"
                                                step="any" name='qty'>
                                            <label for="floatingInput">Qty</label>
                                        </div>
                                        {{--
                                        <div class="form-floating mb-3">
                                            <input type="file" name="image" accept="image/png, image/gif, image/jpeg">
                                        </div> --}}

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submitId"
                                        value="">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="table-responsive ">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="list-report" class="list-report">
                    @foreach ($report as $value)
                        <tr id="tr-data{{ $value->id }}">
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->title }}</td>
                            <td> {{ $value->price }}</td>
                            <td>{{ $value->qty }}</td>
                            <td class="col-3">
                                <button type="button" class="btn btn-success btn-sm" id="editButton"
                                    onclick="editReport('{{ $value->id }}','{{ $value->title }}','{{ $value->price }}','{{ $value->qty }}')">
                                    <span class="px-3"> Edit</span>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" id="deleteButton"
                                    onclick="deleteReport({{ $value->id }})">
                                    <span class="px-3"> Delete</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    <script type="text/javascript">
        // $('#reportForm').submit(function(e) {
        //     e.preventDefault();

        //     alert('hi');

        //     var $form = $(this),
        //         title = $form.find("input[name='title']").val(),
        //         price = $form.find("input[name='price']").val(),
        //         qty = $form.find("input[name='qty']").val(),

        //         $.ajax({
        //             method: "POST",
        //             url: {{ route('report.store') }},
        //             contentType: false,
        //             cache: false,
        //             processData: false,
        //             data: {
        //                 title: title,
        //                 price: price,
        //                 qty: qty
        //             },
        //             dataType: "json",
        //             success: function(data) {
        //                 alert('msg');
        //             }
        //         });

        // });


        function editReport(id, title, price, qty) {
            $('#modalId').modal('show');
            $('#submitId').val('edit')

            localStorage.setItem("rid", id);
            localStorage.setItem("rtitle", title);
            localStorage.setItem("rprice", price);
            localStorage.setItem("rqty", qty);

            $('#reportId').val(id);
            $('#rtitle').val(title);
            $('#rprice').val(price);
            $('#rqty').val(qty);
        }


        $(document).ready(function() {

            $('#addButton').click(function(e) {
                e.preventDefault();
                $('#modalId').modal('show');
                $('#reportForm').trigger("reset");
                $('#submitId').val('add');

            });

            $("#submitId").click(function(e) {
                e.preventDefault();


                // check btn save value
                var state = $('#submitId').val();

                if (state == 'add') {

                    var formData1 = {
                        title: $('#rtitle').val(),
                        price: $('#rprice').val(),
                        qty: $('#rqty').val(),
                    };

                    $.ajax({
                        type: "POST",
                        url: "/api/report",
                        data: formData1,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        cache: false,
                        success: function(data) {

                            const sid = JSON.stringify(data.id);
                            const stitle = JSON.stringify(data.title);
                            const sprice = JSON.stringify(data.price);
                            const sqty = JSON.stringify(data.qty);

                            var dataItem =
                                "<tr><td>" + data.id + "</td> " +
                                "<td>" + data.title + "</td>" +
                                "<td>" + data.price + "</td>" +
                                "<td>" + data.qty + "</td>" +
                                "<td class='col-3'><button type='button'class='btn btn-success btn-sm' id='editButton' onclick='editReport(" +
                                sid + "," + stitle + "," + sprice + "," + sqty +
                                ")'><span class='px-3'> Edit</span></button>" +
                                "<button type='button' class='btn btn-danger btn-sm'><span class='px-3'> Edit</span></button></td>" +
                                "</tr>";

                            if (data.errors) {
                                $("#alert-errorId").show();
                                $("#alert-err-title").text(data.errors);
                            } else {
                                $('#list-report').append(dataItem);
                                $('#reportForm').trigger("reset");
                                $('#modalId').modal('hide')

                                $("#alert-successId").show();
                                $('#alert-suc-title').text('Data Added successfully');
                                $("#alert-errorId").hide();
                            }
                        },
                        error: function(data) {
                            alert('AjaxError');
                        }
                    });

                } else if (state == 'edit') {


                    var lid = localStorage.getItem("rid");
                    var ltitle = localStorage.getItem("rtitle");
                    var lprice = localStorage.getItem("rprice");
                    var lqty = localStorage.getItem("rqty");

                    var getData = {
                        id: lid,
                        title: ltitle,
                        price: lprice,
                        qty: lqty,
                    };
                    var formdataNew = {
                        id: $('#reportId').val(),
                        title: $('#rtitle').val(),
                        price: $('#rprice').val(),
                        qty: $('#rqty').val(),
                    };


                    $('#tr-data' + getData.id).html('');

                    $.ajax({
                        type: "GET",
                        url: "api/report/" + formdataNew.id,
                        data: formdataNew,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(data) {

                            const sid = JSON.stringify(formdataNew.id);
                            const stitle = JSON.stringify(formdataNew.title);
                            const sprice = JSON.stringify(formdataNew.price);
                            const sqty = JSON.stringify(formdataNew.qty);

                            var dataItem =
                                "<td>" + formdataNew.id + "</td> " +
                                "<td>" + formdataNew.title + "</td>" +
                                "<td>" + formdataNew.price + "</td>" +
                                "<td>" + formdataNew.qty + "</td>" +
                                "<td class='col-3'><button type='button'class='btn btn-success btn-sm' id='editButton' onclick='editReport(" +
                                sid + "," + stitle + "," + sprice + "," + sqty +
                                ")'><span class='px-3'> Edit</span></button>" +
                                "<button type='button' class='btn btn-danger btn-sm'><span class='px-3'> Edit</span></button></td>" +
                                "</tr>";

                            $('#tr-data' + getData.id).append(dataItem);

                            $('#modalId').modal('hide');
                            $("#alert-successId").show();
                            $('#alert-suc-title').text('Data Added successfully');


                        },
                        error: function(data) {
                            alert('AjaxError');
                        }
                    });
                }


            });

        });
    </script>
@endsection
