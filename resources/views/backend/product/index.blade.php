<x-backend.layouts.master>
    <x-slot:page_title>
        Product
    </x-slot>
<div class="card mb-4">
    <div class="card-header">

       @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> {{ session('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       @endif

        <i class="fas fa-table me-1"></i>
        <x-slot:title>
            Product List
        </x-slot>
    </div>
    <div class="card-body">
        <a href="{{ route('products.create')}}" class="btn btn-primary">Create</a>
        <a href="{{ route('products.trashed')}}" class="btn btn-warning">Trash list</a>
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>Ser</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
           
            <tbody>

                @foreach ( $products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{  $product->name}}</td>
                    <td>{{  $product->price}}</td>
                    <td><img src="{{ asset('storage/products/'.$product->image) }}" alt="" height="150" width="200"></td>
                    <td>
                        <a href="{{ route('products.show', ['product'=>$product->id])}}" class="btn btn-sm btn-primary">Show</a>
                        <a href="{{ route('products.edit', ['product'=>$product->id])}}" class="btn btn-sm btn-info">Edit</a>
                        <form style="display: inline" action="{{ route('products.destroy', ['product'=>$product->id])}}" method="post">
                            @method('delete')
                            @csrf
                            <button onclick="alert('Are you sure ?')" class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>  
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
</x-backend.layouts.master>