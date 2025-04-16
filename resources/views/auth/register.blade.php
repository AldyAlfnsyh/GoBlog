<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <link rel="icon" type="image/png" href="{{ asset('storage/Goblog-3.png') }}">
    <title>Register</title>
</head>
<body >
    <main class="flex min-h-screen items-center justify-content-center bg-gray-100">
    <div class="w-full  max-w-md mx-auto overflow-hidden bg-white rounded-lg shadow-md ">
        <div class="px-6 py-4">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-20 sm:h-40 border-1 rounded-md" src="{{ asset('storage/Goblog-4.png') }}" alt="">
            </div>
    
            <h3 class="mt-3 text-xl font-medium text-center text-gray-600 ">Register Form</h3>
    
            <p class="mt-1 text-center text-gray-500 ">Create Account</p>
            @if($errors->any())
            <div class="flex w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-md ">
                <div class="flex items-center justify-center w-12 bg-red-600">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg>
                      
                </div>
                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-red-600 ">Message!!!</span>
                        @error('user_name')
                        <p class="text-sm text-gray-600 ">{{$message}}</p>
                        @enderror
                        @error('email')
                        <p class="text-sm text-gray-600 ">{{$message}}</p>
                        @enderror
                        @error('password')
                        <p class="text-sm text-gray-600 ">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            @endif
            
            <form action="/register" method="POST">
                @csrf
                <div class="w-full mt-4">
                    Name
                    <input class=" block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg  focus:outline-none focus:ring focus:ring-blue-300 " type="text" placeholder="full name" name="name" aria-label="Name" />
                </div>
                
                <div class="w-full mt-4">
                    Username
                    <input class=" block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg  focus:outline-none focus:ring focus:ring-blue-300 " type="text" placeholder="minimal 6 character" name="user_name" aria-label="Username" />
                </div>
                
                <div class="w-full mt-4">
                    Email Address
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg  focus:outline-none focus:ring focus:ring-blue-300" type="email" placeholder="email address that is not already taken" name='email' aria-label="Email Address" />
                </div>
    
                <div class="w-full mt-4">
                    Password
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg  focus:outline-none focus:ring focus:ring-blue-300" type="password" placeholder="minimal 8 character" name='password' aria-label="Password" />
                </div>
    
                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Register
                    </button>
                </div>
            </form>
        </div>
    
        <div class="flex items-center justify-center py-4 text-center bg-gray-50 ">
            <span class="text-sm text-gray-600 ">Already Register? </span>
    
            <a href="/login" class="mx-2 text-sm font-bold text-blue-500  hover:underline">Login</a>
        </div>
    </div>

    </main>
</body>
</html>