<x-backend.layouts.master>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <x-slot:title>
            Category Show 
        </x-slot>
    </div>
    <div class="card-body">
       <h2>Name : {{ $category->title }}</h2>
       <p>Description: {{ $category->description }} </p>
    </div>
</div>
</x-backend.layouts.master>