<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('storage/Goblog-3.png') }}">
    <title>Profile</title>
</head>
<body>
    
    
            
            
    <section class="bg-white mt-10">
        <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">

            <form action="/profile" method="POST" enctype="multipart/form-data" class="w-full max-w-md">
                @csrf
                
                <div class="flex justify-center mx-auto">
                    <img class="rounded-full size-50" src="{{ asset('/storage/'. $user['image']) }}" alt="image description">
                </div>
                
                <div class="flex items-center justify-center mt-6">
                    Edit Profile
                </div>
                
                @if(session()->has('success'))
                    <div class="flex w-full  overflow-hidden bg-white rounded-lg shadow-md ">
                        <div class="flex items-center justify-center w-12 bg-emerald-500">
                            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                            </svg>
                        </div>
                        <div class="px-4 py-2 -mx-3">
                            <div class="mx-3">
                                <span class="font-semibold text-emerald-500 ">Success!</span>
                                <p class="text-sm text-gray-600 ">{{session('success')}}</p>
                            </div>
                        </div>
                    </div>
                @endsession

                @if($errors->any())
                    <div class="flex w-full  overflow-hidden bg-white rounded-lg shadow-md ">
                        <div class="flex items-center justify-center w-12 bg-red-600">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>  
                        </div>
                        <div class="px-4 py-2 -mx-3">
                            <div class="mx-3">
                                <span class="font-semibold text-red-600 ">Message!</span>
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
                
                <div class="mt-4">
                    Name
                    <div class="relative flex items-center" >
                        <span class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
        
                        <input type="text" name="name" value='{{$user['name']}}' class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11    focus:border-blue-400  focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Name">
                    </div>
                </div>

                <div class="mt-4">
                    Username
                    <div class="relative flex items-center">
                        <span class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
        
                        <input type="text" name="user_name" value='{{$user['user_name']}}' class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11    focus:border-blue-400  focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Username">
                    </div>
                </div>
    
                <label for="dropzone-file" class="flex items-center px-3 py-3 mx-auto mt-6 text-center bg-white border-2 border-dashed rounded-lg cursor-pointer  ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
    
                    <h2 class="mx-3 text-gray-400">Change Photo</h2>
    
                    <input id="dropzone-file" name='image' value='{{$user['image']}}' type="file" class="hidden" />
                </label>
                
                <div class="mt-4">
                    Email Address
                    <div class="relative flex items-center">
                        <span class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
        
                        <input type="email" value='{{$user['email']}}' name="email" class="block w-full py-3 text-gray-700 bg-white border rounded-lg px-11    focus:border-blue-400  focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Email address">
                    </div>
                </div>
                
                <div class="mt-4">
                    Password
                    <div class="relative flex items-center">
                        <span class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-gray-300 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
        
                        <input type="password" name="password" class="block w-full px-10 py-3 text-gray-700 bg-white border rounded-lg    focus:border-blue-400  focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Password">
                    </div>
                </div>
    
    
                <div class="mt-4  mb-10">
                    <button type="submit"class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Update Profile
                    </button>
    
                    
                </div>
            </form>
        </div>
    </section>
</body>
</html>