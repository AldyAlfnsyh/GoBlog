<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <x-slot:header_title>{{$header_title}}</x-slot>


    {{-- Hero Section --}}
    <div class="bg-slate-300">
        <div class="lg:flex mx-auto max-w-7xl ">
            <div class="flex items-center justify-center w-full px-6 py-8 lg:h-[32rem] lg:w-1/2">
                <div class="max-w-xl">
                    <h2 class="text-6xl font-semibold text-gray-800  lg:text-4xl">Create Your New <span class="text-blue-600 ">Article</span></h2>

                    <p class="mt-4 text-sm text-gray-500  lg:text-base">Welcome to GoBlog, a place where everyone can share their ideas, experiences, and insights through blogging. Whether you're a seasoned writer or just starting, this is the perfect platform for you!</p>

                    <div class="flex flex-col mt-6 space-y-3 lg:space-y-0 lg:flex-row">
                        <a href="{{route('dashboard')}}" class="block px-5 py-2 text-sm font-medium tracking-wider text-center text-white transition-colors duration-300 transform bg-gray-900 rounded-md hover:bg-gray-700">Start Writing</a>  
                        <p class="block px-5 py-2 text-sm text-gray-800 lg:text-base">&nbsp;- Join us and share your first blog!</p>
                    </div>
                </div>
            </div>

            <div class="w-full h-64 lg:w-1/2 lg:h-auto">
                <div class="w-full h-full bg-cover" style="background-image: url(https://images.unsplash.com/photo-1508394522741-82ac9c15ba69?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=748&q=80)">
                    <div class="w-full h-full bg-black opacity-25"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- Hero section --}}

    {{-- Recent Post --}}
    <section class=" mx-auto max-w-7xl ">
        <div class="container px-6 py-10 mx-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl ">recent posts </h1>
    
                <div class="flex justify-center mt-6">
                    <a href="/posts" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-500 transition duration-300">
                        More Posts →
                    </a>
                </div>
            </div>
    
            <hr class="my-8 border-gray-200 "/>
            
            
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($posts as $post)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <img class="object-cover object-center shadow-lg w-full h-64 rounded-lg lg:h-80"  src="{{ $post['image'] ? asset('/storage/'.$post['image']) : asset('/storage/post/post_image_default.jpg')}}"  alt="">
    
                    <div class="mt-8">
                        <a href="/categories/{{$post->category['slug']}}" class="text-blue-500 uppercase hover:underline hover:text-blue-400">{{$post->category['name']}}</a>
    
                        <h1 class="mt-4 text-xl font-semibold text-gray-800">
                            {{$post['title']}}

                        </h1>
    
                        <p class="mt-2 text-gray-500 ">
                            {{ Str::limit(preg_replace('/\xC2\xA0/', ' ', html_entity_decode(strip_tags($post['body']))), 150) }}
                        </p>
    
                        <div class="flex items-center justify-between mt-4">
                            <div>
                                <a href="/authors/{{$post->author['slug']}}" class="text-lg font-medium text-gray-700  hover:underline hover:text-gray-500">
                                    {{$post->author['name']}}
                                </a>
    
                                <p class="text-sm text-gray-500 ">{{$post['created_at']->diffForHumans()}}</p>
                            </div>
    
                            <a href="/posts/{{$post['slug']}}" class="inline-block text-blue-500 hover:underline hover:text-blue-400">Read more</a>
                        </div>
    
                    </div>
                </div>
                @endforeach
            </div>
            

        </div>
    </section>

    



</x-layout>