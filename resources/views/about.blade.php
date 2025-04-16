<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <x-slot:header_title>{{$header_title}}</x-slot>
    <section class="bg-slate-300">
      <div class="container px-6 py-16 mx-auto max-w-7xl ">
          <div class="items-center lg:flex">

              <div class="w-full lg:w-1/2">
                  <div class="lg:max-w-lg">
                      <h1 class="text-5xl font-semibold text-gray-800 ">What is Website <br><span class="text-blue-500 ">GoBlog ?</span></h1>
                      
                      <p class="mt-3 text-gray-600" >Website GoBlog is an open blogging platform where anyone can read and write articles. Whether you want to share knowledge, express creativity, or connect with like-minded people, this is the right place!</p>
                      
                  </div>
              </div>

              <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                  <img class="w-full h-full max-w-md lg:max-w-3xl rounded-md shadow-md" src="{{asset('/storage/about.jpg')}}" alt="Catalogue-pana.svg">
              </div>
              
          </div>
      </div>
  </section>
  
  <div class="mx-auto max-w-7xl container flex flex-col px-6 py-10  space-y-6 lg:h-[32rem] lg:py-16 lg:flex-row lg:items-center">
      <div class="w-full lg:w-1/2">
          <div class="lg:max-w-lg">
              <h1 class="text-3xl font-semibold tracking-wide text-gray-800  lg:text-4xl">
                  How It Works?
              </h1>

              <div class="mt-8 space-y-5">
                  <p class="flex items-center -mx-2 text-gray-700 ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>

                      <span class="mx-2">Explore → Discover various interesting blogs
                          
                          </span>
                  </p>

                  <p class="flex items-center -mx-2 text-gray-700 ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>

                      <span class="mx-2">Write → Become a writer and share your story</span>
                  </p>

                  <p class="flex items-center -mx-2 text-gray-700 ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>

                      <span class="mx-2">Engage → Interact with the community</span>
                  </p>
              </div>
          </div>
      </div>

      <div class="flex items-center justify-center w-full h-96 lg:w-1/2">
          <img class="object-cover w-full h-full mx-auto max-w-md rounded-md lg:max-w-2xl shadow-lg" src="https://images.unsplash.com/photo-1543269664-7eef42226a21?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="glasses photo">
      </div>
  </div>
    
  </x-layout>
  
    
