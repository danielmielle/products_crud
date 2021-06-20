@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Products</h2>
                        <a  type="button"
                            href="{{route('products.create')}}"
                            class="btn btn-success float-right">
                            Create
                        </a>
                </div>
                <div class="card-body">
                    {{--@if (session('message'))--}}
                        {{--<div class="alert alert-{{session('status')}}" role="alert" id="test">--}}
                            {{--<h4>{{ session('message') }}</h4>--}}
                        {{--</div>--}}
                        {{--<script>--}}
                            {{--$('#test').show().delay(100).fadeIn('fast');--}}
                            {{--$('#test').hide().delay(2000).fadeOut('slow');--}}
                        {{--</script>--}}
                    {{--@endif--}}

                    @if(session('message'))
                        <script>
                            swal("{{session('message')}}"," ","{{session('status')}}",{
                                button:"OK",
                            })
                        </script>
                    @endif

                    <table class="table table-striped table-hover" id="table_id">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Product Name</th>
                            <th>Description </th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <input type="hidden" class="delete_val" value="{{$product->id}}">
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>
                                        <a  type="button"
                                            href="{{route('products.edit',$product->id)}}"
                                            class="btn btn-primary">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-danger deleteAlert">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                "ordering": false
            });
        } );
    </script>
    <script>
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.deleteAlert').click(function (e){
                //getting the hidden ID
                var delete_id = $(this).closest("tr").find('.delete_val').val();
                //creating sweetalert for delete with confirmation
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this product",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if(willDelete){

                    var data = {
                        "_token": $('input[name="csrf-token"]').val(),
                        "id": delete_id,
                    };
                    //getting the delete form and delete with response
                    $.ajax({
                        type:"DELETE",
                        url: '/delete/'+delete_id,
                        data: "data",
                        success: function (response){
                            swal(response.status , {
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                            });

                        }
                    });
                }
            });
            });
        });
    </script>
@endsection
@endsection
