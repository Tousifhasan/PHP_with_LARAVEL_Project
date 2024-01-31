<x-backend.layouts.master>
    <x-slot:page_title>
        Category
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
            Category List
        </x-slot>
    </div>
    <form action="" method="get">
        @csrf
        <input type="search" name="keyword" id="">
        <button type="submit">Search</button>
    </form>
    <div class="card-body">
        @can('create-category') 
        <a href="{{ route('categories.create')}}" class="btn btn-primary">Create</a>
        @endcan
        <a href="{{ route('categories.pdf')}}" class="btn btn-warning">PDF</a>
        <a href="{{ route('categories.excel')}}" class="btn btn-success">Excel</a>
        {{-- <table id="datatablesSimple" class="table table-striped"> --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ser</th>
                    <th>Name</th>
                    <th>description</th>
                    <th>Action</th>
                </tr>
            </thead>
           
            <tbody>

                @foreach ( $categories as $category)
                <tr>
                    <td>{{ $categories->firstItem()+$loop->index }}</td>
                    <td>{{  $category->title}}</td>
                    <td>{{  $category->description}}</td>
                    <td>
                        <a href="{{ route('categories.show', ['category'=>$category->id])}}" class="btn btn-sm btn-primary">Show</a>
                        <a href="{{ route('categories.edit', ['category'=>$category->id])}}" class="btn btn-sm btn-info">Edit</a>
                        <form style="display: inline" action="{{ route('categories.destroy', ['category'=>$category->id])}}" method="post">
                            @method('delete')
                            @csrf
                            <button onclick="alert('Are you sure ?')" class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>  
                @endforeach
                
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>
</x-backend.layouts.master>