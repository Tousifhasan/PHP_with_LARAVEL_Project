<x-backend.layouts.master>
    <x-slot:page_title>
        Category
    </x-slot>
<div class="card mb-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <x-slot:title>
            Category Create
        </x-slot>
    </div>
    <div class="card-body">
        <a href="{{ route('categories.list')}}" class="btn btn-primary">List</a>
        <form action="{{ route('categories.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" value="{{ old('title')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
             <textarea name="description" class="form-control" id="description" cols="40" rows="5">
                {{ old('description')}}
             </textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 form-check">
                <label for="file">Image</label>
                <input type="file" name="image" id="file" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
</x-backend.layouts.master>