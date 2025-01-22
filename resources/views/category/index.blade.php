<x-app-layout></x-app-layout>

<div class="bg-white shadow-md rounded-lg p-6 m-4">
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-gray-800 text-lg font-semibold">Categories</h4>
        
        <a 
            href="{{ url('/categories/create') }}" 
            class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-300 ease-in-out"
        >
            Add Category
        </a>
    </div>
</div>

<div class="bg-white shadow-lg rounded-lg overflow-x-auto p-6 m-4">
@if(session('status'))
            <div class="bg-green-100 text-green-700 border border-green-300 rounded-lg p-4">
                {{ session('status') }}
            </div>
        @endif
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Category Name</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            @foreach($categories as $category)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">{{$category->id}}</td>
                <td class="py-3 px-6 text-left">{{$category->category_name}}</td>
                <td class="py-3 px-6 text-left">{{$category->description}}</td>
                <td class="py-3 px-6 text-center">
                        <a href="{{url('categories/'.$category->id.'/edit')}}" class="inline-block bg-blue-500 text-white font-semibold px-6 py-3 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-300 ease-in-out">Edit</a> |
                        <!-- Delete Form -->
                        <a 
    href="{{ route('categories.delete', $category->id) }}" 
    class="bg-red-500 text-white font-semibold px-6 py-3 rounded-md shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition duration-300 ease-in-out"
    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this category?')) { document.getElementById('delete-form-{{ $category->id }}').submit(); }"
>
    Delete
</a>

<!-- Hidden form for DELETE method -->
<form 
    id="delete-form-{{ $category->id }}" 
    action="{{ route('categories.delete', $category->id) }}" 
    method="POST" 
    style="display: none;"
>
    @csrf
    @method('DELETE')
</form>


                </td>

            </tr>
            @endforeach
            </tbody>
        </table>
          
    </div>
</div>
  

