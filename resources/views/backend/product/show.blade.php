<x-backend.layouts.master>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <x-slot:title>
            Product Show 
        </x-slot>
    </div>
    <div class="card-body">
       <h2>Name : {{ $product->name }}</h2>
       <p>Description: <strong> {{ $product->description }}</strong> </p>
       <p>Price: <strong>{{ $product->price }} <span style="font-size: 20px; font-weight:700">&#2547;</span></strong> </p>
       <p>Image: <img src="{{ asset('storage/products/'.$product->image)}}" alt="" width="400" height="auto" > </p>
    </div>
</div>
</x-backend.layouts.master>