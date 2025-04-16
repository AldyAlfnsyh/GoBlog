<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('storage/Goblog-3.png') }}">
    <title>Login</title>
</head>
<body >
    
    <main class="flex min-h-screen items-center justify-content-center bg-gray-100">
        
    <div class="w-full  max-w-md mx-auto overflow-hidden bg-white rounded-lg shadow-md ">
        
        <div class="px-6 py-4">

            
            <div class="pt-6 flex justify-center mx-auto">
                <img class="w-auto h-20 sm:h-40 border-1 rounded-md" src="{{ asset('storage/Goblog-4.png') }}" alt="">
            </div>
            

            <h3 class="mt-3 text-xl font-medium text-center text-gray-600 ">Sign in</h3>
    
            <p class="mt-1 text-center text-gray-500 ">Login or create account</p>

            
            @if(session()->has('errorLogin'))
        <div class="flex w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-md ">
            <div class="flex items-center justify-center w-12 bg-red-600">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>                  
            </div>
            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-red-600 ">Message!!!</span>
                    <p class="text-sm text-gray-600 ">{{session('errorLogin')}}</p>
                </div>
            </div>
        </div>
            @endsession
            
            @if(session()->has('success_register'))
            
            <div class="flex w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-md ">
            <div class="flex items-center justify-center w-12 bg-emerald-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                </svg>
            </div>
            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-emerald-500 ">Success!</span>
                    <p class="text-sm text-gray-600">{{session('success_register')}}</p>
                </div>
            </div>
        </div>
            @endsession
            <form action="/login" method="POST">
                @csrf
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg  focus:outline-none focus:ring focus:ring-blue-300" name="email" type="email" placeholder="Email Address" aria-label="Email Address" autofocus autocomplete="off" required/>
                </div>
    
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg  focus:outline-none focus:ring focus:ring-blue-300" name="password" type="password" placeholder="Password" aria-label="Password" required/>
                </div>
    
                <div class="flex items-center justify-between mt-4">
                    <a href="#" class="text-sm text-gray-600  hover:text-gray-500">Forget Password?</a>
    
                    <button class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50" type="submit">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    
        <div class="flex items-center justify-center py-4 text-center bg-gray-50 ">
            <span class="text-sm text-gray-600 ">Don't have an account? </span>
    
            <a href="/register" class="mx-2 text-sm font-bold text-blue-500  hover:underline">Register</a>
        </div>
    </div>

    </main>
</body>
</html>