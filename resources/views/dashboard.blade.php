<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <x-slot:header_title>{{$header_title}}</x-slot>
    

<div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 ">
    <dl class="mt-6 grid grid-cols-1 gap-4 sm:mt-8 sm:grid-cols-2 lg:grid-cols-4">
      <div class="flex flex-col rounded-lg bg-blue-600 px-4 py-8 text-center">
        <dt class="order-last text-lg font-medium text-gray-800">Total Article</dt>
  
        <dd class="text-4xl font-extrabold text-white md:text-5xl">{{$total_article}}</dd>
      </div>
  
      <div class="flex flex-col rounded-lg bg-blue-600 px-4 py-8 text-center">
        <dt class="order-last text-lg font-medium text-gray-800">Total Like</dt>
  
        <dd class="text-4xl font-extrabold text-white md:text-5xl">{{$total_like}}</dd>
      </div>
  
      <div class="flex flex-col rounded-lg bg-blue-600 px-4 py-8 text-center">
        <dt class="order-last text-lg font-medium text-gray-800">Total Dislike</dt>
  
        <dd class="text-4xl font-extrabold text-white md:text-5xl">{{$total_dislike}}</dd>
      </div>
  
      <div class="flex flex-col rounded-lg bg-blue-600 px-4 py-8 text-center">
        <dt class="order-last text-lg font-medium text-gray-800">Like Percentage</dt>
  
        <dd class="text-4xl font-extrabold text-white md:text-5xl">{{$like_percentage}}%</dd>
      </div>
    </dl>
  </div>
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            
            <div class="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" action="/dashboard" method='GET'>
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="search" id="simple-search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2" placeholder="Search" >
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="/create-article" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2   focus:outline-none ">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add article
                        </a>
                    </div>
                </div>
                {{-- {{dd($myposts)}} --}}
                @if ($myposts->isEmpty())
            <p class="text-center text-gray-500 text-lg">Data belum ada</p>
    @else
                <div class="overflow-x-auto relative overflow-visible">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                            <tr>
                                <th scope="col" class="px-4 py-3">Title</th>
                                <th scope="col" class="px-4 py-3">Category</th>
                                <th scope="col" class="px-4 py-3"></th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myposts as $post)
                            <tr class="border-b ">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">{{$post['title']}}</th>
                                <td class="px-4 py-3">{{$post->category['name']}}</td>
                                <td class="px-4 py-3">{{ Str::limit(strip_tags($post['body']),150)}}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="{{$post['title']}}-dropdown-button" data-dropdown-toggle="{{$post['title']}}-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none  :text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="{{$post['title']}}-dropdown" class=" hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow  ">
                                        <ul class="py-1 text-sm text-gray-700 " aria-labelledby="{{$post['title']}}-dropdown-button">
                                            <li>
                                                <a href="/posts/{{$post['slug']}}" class="block py-2 px-4 hover:bg-gray-100 :bg-gray-600 ">Show</a>
                                            </li>
                                            <li>
                                                <a href="/create-article/{{$post['slug']}}" class="block py-2 px-4 hover:bg-gray-100 :bg-gray-600 ">Edit</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <form action="/dashboard" method="POST">
                                                @csrf
                                            <input type="hidden" name="id" value="{{$post['id'] ?? ''}}"/>
                                            <button type='submit' class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 :bg-gray-600  ">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <nav class="m-4" aria-label="Table navigation">
                    {{ $myposts->links('vendor.pagination.tailwind') }}
                </nav>
            </div>
        </div>
        {{-- </section> --}}
    
  </x-layout>