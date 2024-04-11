<x-admin-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-2">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Edit User</h2>
      <p class="mb-4">Edit: {{$user->name}}</p>
    </header>

    <form method="POST" action="/admin/auth/{{$user->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="mb-6">
        <label for="name" class="inline-block text-lg mb-2"> Name</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
          value="{{$user->name}}" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">Email</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" readonly name="email"
           value="{{$user->email}}" />

        @error('email')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="role" class="inline-block text-lg mb-2">Role</label>
        <select class="border border-gray-200 rounded p-2 w-full" name="role">
          <option value="user" @if($user->role === 'user') selected @endif>user</option>
          <option value="admin" @if($user->role === 'admin') selected @endif>admin</option>
        </select>
      
        @error('role')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>
      

      <div class="mb-6">
        <label for="password" class="inline-block text-lg mb-2">
          Password
        </label>
        <input type="password" class="border border-gray-200 rounded p-2 w-full" readonly name="password" value="{{$user->password}}" />

        @error('password')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

   

          <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Update user
        </button>

        <a href="{{ url()->previous() }}" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-admin-layout>
