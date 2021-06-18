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
                    @if (session('message'))
                        <div class="alert alert-{{session('status')}}" role="alert" id="test">
                            <h4>{{ session('message') }}</h4>
                        </div>
                        <script>
                            $('#test').show().delay(100).fadeIn('fast');
                            $('#test').hide().delay(2000).fadeOut('slow');
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
                                        <a type="button" class="btn btn-danger"
                                           onclick="event.preventDefault();
                                                   document.getElementById('delete-user-form-{{ $product->id }}').submit()">
                                           Delete
                                        </a>
                                        <form id="delete-user-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method("DELETE")
                                        </form>
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
@endsection
@section('styles')

@endsection
@endsection
