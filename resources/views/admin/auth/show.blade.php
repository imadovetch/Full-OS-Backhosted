<x-admin-layout>
  <a href="{{ url()->previous() }}" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4 flex justify-center items-center h-full rounded-sm">
    <x-card>
    <header>
      <h1 class="text-3xl text-center font-bold my-6 uppercase">
        User Details
      </h1>
    </header>

    <table class="w-80 table-auto rounded-sm">
      <tbody>
        <tr>
          <td class=" font-bold">Name:</td>
          <td class="">{{$user->name}}</td>
        </tr>
        <tr>
          <td class=" font-bold">Email:</td>
          <td class="">{{$user->email}}</td>
        </tr>
        <tr>
          <td class=" font-bold">Role:</td>
          <td class="">{{$user->role}}</td>
        </tr>
      </tbody>
    </table>
    <div class="mt-4 p-2 flex space-x-6">
      <a href="/admin/auth/{{$user->id}}/edit" class="text-green-500 hover:text-green-700">
        <i class="fa-solid fa-pencil text-green-500"></i> Edit
      </a>
        <form method="POST" action="/admin/auth/{{$user->id}}">
          @csrf
          @method('DELETE')
          <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
        </form>
    </div>
  </x-card>

  </div>
</x-admin-layout>