
<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <x-slot:header_title>{{$header_title}}</x-slot>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-md sm:text-center">
                    
                    <form action="/posts" method='GET'>
                        <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                            <div class="relative w-full">
                            
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    
                                    <svg class="w-5 h-5 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                      </svg>
                                </div>
                                <input class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 " placeholder="Search for article" type="search" id="search" name="search" autocomplete="off">

                            </div>
                            <div>
                                <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if ($posts->isEmpty())
            <p class="text-center text-gray-500 text-lg">Data belum ada</p>
            @else
            {{ $posts->links('vendor.pagination.tailwind') }}
            
            <div class="py-6 grid gap-8 lg:grid-cols-2">
                
                
    
            @foreach ($posts as $post)
                
            
                    <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md ">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <a href="/categories/{{$post->category['slug']}}" class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded ">
                                <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                                {{ $post->category['name']}}
                            </a>
                            <span class="text-sm">{{ $post['created_at']->diffForHumans()}}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">
                            <a href="/posts/{{$post['slug']}}">{{ $post['title']}}</a></h2>
                        <p class="mb-5 font-light text-gray-500 ">{{ Str::limit(strip_tags($post['body']),150)}}</p>
                        <div class="rounded-full border-2 border-gray-400 w-max p-1 mb-5 font-light text-gray-500 flex col ">
                            <svg  class="w-6 h-6 text-gray-500"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                            </svg>
                            {{ $post->like_count}}
                            |
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd"/>
                            </svg>
                            {{ $post->dislike_count}}
                        
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="/authors/{{$post->author['slug']}}" class="flex items-center space-x-4">
                                <img class="w-7 h-7 rounded-full" src="{{ asset('/storage/'. $post->author['image']) }}" alt="Author Profile Image" />
                                <span class="font-medium \">
                                    {{ $post->author['name']}}
                                </span>
                            </a>
                            <a href="/posts/{{$post['slug']}}" class="inline-flex items-center font-medium text-primary-950  hover:underline">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </article>  
    @endforeach
   
    
    </div>
    {{ $posts->links('vendor.pagination.tailwind') }}
    @endif
    </div>

  </x-layout>

