<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/favicon.ico" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('navbar', () => ({
        isMobileMenuOpen: false,
      }));
    });
  </script>
  <script>
    tailwind.config = {
        theme: {
          extend: {
            colors: {
              laravel: '#666699',
            },
          },
        },
      }
  </script>
  <title>MicroGigs | Find software Jobs & Projects</title>
</head>

<body class="mb-16 bg-gray-300">
  <nav class=" bg-gray-300 border-b-4 border-[#113F67]">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="/admin" class="flex items-center">
        <img src="{{asset('images/logoM.png')}}"class="h-8 mr-3" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Micro<span class="text-[#38B6FF]">Gigs</span></span>
    </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4  md:flex-row md:space-x-8 md:mt-0 ">
          @auth
          <li>
            <span class="font-bold uppercase">
              Welcome {{auth()->user()->name}}
            </span>
          </li>
          <li>
            <a href="/admin/auth/manage" class=" text-black hover:text-laravel"><i class="fa fa-address-book" aria-hidden="true"></i>
              Manage Users</a>
    
          </li>
          <li>
            <a href="/admin/listings/create" class=" text-black hover:text-laravel"><i class="fa fa-laptop" aria-hidden="true"></i>
            </i>
              Post Job</a>
    
          </li>
          <li>
            <a href="/admin/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage Listings</a>
          </li>
          <li>
            <a href="/admin/auth/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
          </li>
          <li>
            <form class="inline" method="POST" action="/logout">
              @csrf
              <button type="submit">
                <i class="fa-solid fa-door-closed"></i> Logout
              </button>
            </form>
          </li>
          @else
          <li>
            <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
          </li>
          <li>
            <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
  

  <main>
    {{$slot}} 
  </main>
  <footer
    class="fixed bottom-0 left-0 w-full  items-center font-bold bg-laravel text-white h-auto mt-24 opacity-90 md:justify-center">
    <p class="py-2 text-center">Copyright &copy; 2023, All Rights reserved</p>

  </footer>

  <x-flash-message />
</body>

</html>