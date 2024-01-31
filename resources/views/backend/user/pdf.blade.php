<table>
    <thead>
        <tr>
            <th>Ser</th>
            <th>Name</th>
            <th>description</th>
        </tr>
    </thead>
   
    <tbody>

        @foreach ( $categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{  $category->title}}</td>
            <td>{{  $category->description}}</td>
        </tr>  
        @endforeach
        
    </tbody>
</table>


<style>
    table, tr, th, td{
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;

    }
    table{
        width: 100%;
    }
</style>