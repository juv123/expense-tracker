<x-app-layout></x-app-layout>
<div class="container mx-auto py-8">
<div class="max-w-md mx-auto mb-4">
        @if(session('status'))
            <div class="bg-green-100 text-green-700 border border-green-300 rounded-lg p-4">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
                
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Category</h2>
        
        <form action="{{url('categories/'.$category->id.'/edit')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Category Name</label>
                <input 
                    type="text" 
                    name="category_name" 
                    id="category_name" 
                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $category->category_name }}" />                   
                
                @error('category_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4" 
                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ $category->description }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-4 justify-center">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                   Update
                </button>
                <button 
                    type="reset" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                   Cancel
                </button>
            </div>
        </form>
    </div>
</div>
