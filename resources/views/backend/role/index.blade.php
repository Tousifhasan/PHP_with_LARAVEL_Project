<x-backend.layouts.master>
    <x-slot:page_title>
        Roles
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
            Role List
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
                    {{-- <th>Role</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
           
            <tbody>

                @foreach ( $roles as $role)
                <tr>
                    <td>{{ $roles->firstItem()+$loop->index }}</td>
                    {{-- <td>{{ $loop->index+1}}</td> --}}
                    <td>{{  $role->name}}</td>
                    {{-- <td>{{  $role->users->name}}</td> --}}
                    <td>
                        <a href="{{ route('role.user-list', ['role'=>$role->id])}}" class="btn btn-sm btn-primary">Show</a>                       
                    </td>
                </tr>  
                @endforeach
                
            </tbody>
        </table>
        {{ $roles->links() }}
    </div>
</div>
</x-backend.layouts.master>