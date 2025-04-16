

<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <x-slot:header_title>{{$header_title}}</x-slot>
    {{-- {{dd($posts)}} --}}
    <div class='mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8'>
    <header class="mb-4 lg:mb-6 not-format">
        <address class="flex items-center mb-6 not-italic">
            <div class="inline-flex items-center mr-3 text-sm text-gray-900 ">
                <img class="mr-4 w-16 h-16 rounded-full" src="{{ asset('/storage/'. $post->author['image']) }}" alt="Author Profile Image"/>
                <div>
                    <a href="/authors/{{ $post->author['slug']}}" rel="author" class="text-xl font-bold text-gray-900 ">{{ $post->author['name']}}</a>
                    <p>
                        <a href="/categories/{{ $post->category['slug']}}" class="text-base text-gray-500 ">{{ $post->category['name']}}</a>
                    </p>
                    <p class="text-base text-gray-500 "><time pubdate datetime="2022-02-08" title="February 8th, 2022">{{ $post['created_at']->format('j F Y')}}</time></p>
                    <form action="{{ route('postLikeOrDislike', $post->id) }}" method="POST" class=" flex col">
                        @csrf
                        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-gray-200 border border-gray-200 rounded-full sm:flex shadow-md ">
                        <li class="w-full ">
                            <div class="flex items-center ps-3">
                                <button type="submit" name="type" value="like" class=" flex col">
                                    <svg  class="w-6 h-6 {{ $post->likes->where('type', 'like')->where('user_id',Auth::id())->count()==1 ? 'text-gray-900' : 'text-gray-500' }}"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                    </svg>
                                    <div class="text-base text-gray-500 ">
                                        {{ $post->like_count}} 
                                    </div>
                                </button>
                            </div>
                        </li>
                        <li >
                            <div class="flex items-center ps-3 text-gray-400"><p>|</p>
                                </div>
                        </li>
                        <li class="w-full ">
                            <div class="flex items-center ps-3">
                                <button type="submit" name="type" value="dislike" class=" flex col">
                                    <svg class="w-6 h-6 {{ $post->likes->where('type', 'dislike')->where('user_id',Auth::id())->count()==1 ? 'text-gray-900' : 'text-gray-500' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd"/>
                                    </svg>
                                    <div class="text-base text-gray-500 ">
                                        {{ $post->dislike_count }} 
                                    </div>
                                </button>
                            </div>
                        </li>
                        @if($post->author['id']!=Auth::id() && Auth::check())
                        <li >
                            <div class="flex items-center ps-3 text-gray-400"><p>|</p>
                                </div>
                        </li>
                        <li class="w-full ">
                            <div class="flex items-center ps-3 px-2 hover:bg-gray-300">
                                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="bottom-start" class="flex col " type="button">
                                    <img width="30" height="30" src='{{asset('/storage/report.png')}}' title="ui icons"></img>
                                </button>
                            </div>
                        </li>
                        @else
                        @endif
                    </ul>
                    </form>
                    <div id="dropdownDots" class="z-10 hidden bg-gray-200 divide-y divide-gray-100 rounded-lg shadow">
                        <form action="{{route('post.report', $post['id'])}}" method="post" class="p-2 max-w-sm mx-auto">
                            @csrf
                            <label for="report" class="block mb-2 text-sm font-medium text-gray-900">Select Type</label>
                            <select id="report" name='type_id' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>choose</option>
                                @foreach($reports as $report)
                                    <option value="{{$report['id']}}" >{{$report['name']}}</option>
                                @endforeach                              
                            </select>
    
                            <input type="hidden" name='post_id' value='{{$post['id']}}'/>
                            <div class=" mt-2">
                                <textarea class="w-full border p-2 rounded-lg" name='message' rows="3" placeholder="please write for the spesific report"></textarea>
                                <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Message Report</button>
                            </div>
    
                        </form>
                    </div>
                    
                </div>
            </div>
        </address>
        <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl ">{{ $post['title']}}</h1>
    </header>
    <br>
    <br>
    <div>
        @if($post['image'])
        <img class="w-full h-auto max-w-xl mx-auto rounded-lg" src="{{asset('/storage/'. $post['image'])}}" alt="image description"/>
        @else
        @endif
    </div>
    <br>
    <br>
            
    <article class="prose">{!! $post['body'] !!}</article>
    <section class="not-format">
        <div class="flex justify-between items-center my-6 ">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 ">Discussion ({{$count_discussion}})</h2>
        </div>
        <form action="{{route('post.comment', $post['id'])}}" method="POST" class="mb-6">
            @csrf
            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200  ">
                <label for="comment" class="sr-only">Your comment</label>
                {{-- <input type="hidden" name="post_id" value="{{$post['id']}}"/> --}}
                <textarea id="comment" rows="6"
                            name="comment"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0   "
                            placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit"
                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200  hover:bg-primary-800"
                >Post comment
            </button>
        </form>
                
        @foreach($comments as $comment)
        <article class="p-6 mb-6 text-base bg-white rounded-lg ">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900 ">
                        <img class="mr-2 w-6 h-6 rounded-full"
                             src="{{asset('/storage/'.$comment->user['image'])}}"
                             alt="user name">
                        {{$comment->user['name']}}
                    </p>
                    <p class="text-sm text-gray-600 ">
                        <time pubdate datetime="2022-02-08"
                            title="February 8th, 2022"
                        >{{$comment['created_at']->diffForHumans()}}
                        </time>
                    </p>
                </div>
                
                @auth
                <button id="{{$comment['id']}}-Button-1" 
                    data-dropdown-toggle="dropdown-{{$comment['id']}}-1"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                    type="button">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                    </svg>
                    <span class="sr-only">Comment settings</span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown-{{$comment['id']}}-1" class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow">
                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                        @if($comment->user['id']==Auth::id())
                        <li class=" block py-2 px-4 hover:bg-gray-100">
                            <button type="button" data-comment-id="comment-edit-{{$comment['id']}}" class="reply-button w-full text-left">Edit</button>
                        </li>
                        <li class="block py-2 px-4 hover:bg-gray-100  ">
                            <form action="/posts/{{$post['slug']}}/comment_delete" method="post">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{$comment['id']}}">
                                <button type='submit' class="w-full text-left" >Remove</button>
                            </form>
                        </li>
                        @else
                        <li class="block px-4 py-2 hover:bg-gray-100">
                            <button id="{{$comment['id']}}-report-comment" 
                            data-dropdown-toggle="dropdown-report-comment-{{$comment['id']}}"
                            type='button'
                            class="w-full text-left">Report</button>
                            
                         </li>
                        @endif
                        
                    </ul>
                </div>
                <div id="dropdown-report-comment-{{$comment['id']}}" class="hidden px-2 py-2 bg-white rounded divide-y divide-gray-100 shadow">
                    <form action="{{route('comment.report', $post['id'])}}" method="post" class="max-w-sm mx-auto">
                        @csrf
                        <label for="report" class="block mb-2 text-sm font-medium text-gray-900">Select Type</label>
                        <select id="report" name='type_id' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>choose</option>
                            @foreach($reports as $report)
                                <option value="{{$report['id']}}" >{{$report['name']}}</option>
                            @endforeach                              
                        </select>

                        <input type="hidden" name='comment_id' value='{{$comment['id']}}'/>
                        <div class=" mt-2">
                            <textarea class="w-full border p-2 rounded-lg" name='message' rows="3" placeholder="please write for the spesific report"></textarea>
                            <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Message Report</button>
                        </div>

                    </form>
                </div>
                @else
                @endif
            </footer>

            <p>{{$comment['content']}}</p>

            <form action="{{route('post.comment.reply', $post['id'])}}" method="post">
                @csrf
                <div class="flex items-center mt-4 space-x-4">
                    <button type="button"
                            class="reply-button flex items-center font-medium text-sm text-gray-500 hover:underline"
                            data-comment-id="{{$comment['id']}}">
                        <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                        </svg>
                        Reply
                    </button>
                </div>
                

                <!-- Textarea untuk Reply (Disembunyikan Default) -->
                <input type="hidden" name='comment_id' value='{{$comment['id']}}'/>
                <div id="reply-form-{{$comment['id']}}" class="hidden mt-2">
                    <textarea class="w-full border p-2 rounded-lg" name='content' rows="3" placeholder="Write a reply..." required></textarea>
                    <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Post Reply</button>
                </div>
            </form>

                <!-- Textarea untuk Edit Comment (Disembunyikan Default) -->
                <form action="/posts/{{$post['slug']}}/comment_edit" method="POST">
                    @csrf
                    <input type="hidden" name='comment_id' value='{{$comment['id']}}'/>
                    <div id="reply-form-comment-edit-{{$comment['id']}}" class="hidden mt-2">
                        <textarea class="w-full border p-2 rounded-lg" name='content' rows="3" required>{{$comment['content']}}</textarea>
                        <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Comment update</button>
                    </div>
                </form>

                @foreach($replies as $reply)
                @if($reply['comment_id'] == $comment['id'])

                <article class="p-6 mb-6 ml-6 lg:ml-12 border-b text-base bg-white  ">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900 ">
                                <img class="mr-2 w-6 h-6 rounded-full"
                                     src="{{asset('/storage/'. $reply->user['image'])}}"
                                     alt="user name">
                                {{$reply->user['name']}}
                            </p>
                            <p class="text-sm text-gray-600 ">
                                <time pubdate datetime="2022-02-12" title="February 12th, 2022">{{$reply['created_at']->diffForHumans()}}</time>
                            </p>
                        </div>
                        
                        @auth
                        <button id="reply-menu2-{{$reply['id']}}-button" data-dropdown-toggle="dropdown-menu2-{{$reply['id']}}"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50   "
                                type="button">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                            </svg>
                            <span class="sr-only">Comment settings</span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown-menu2-{{$reply['id']}}"
                             class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow  ">
                            <ul class="py-1 text-sm text-gray-700 "
                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                @if($reply->user['id']==Auth::id())
                                <li class="block py-2 px-4 hover:bg-gray-100">
                                    <button type="button" data-comment-id="reply-edit-{{$reply['id']}}" class="reply-button  w-full text-left ">Edit</button>
                                </li>
                                <li class="block py-2 px-4 hover:bg-gray-100">
                                    <form action="{{route('reply.delete', $post['id'])}}" method="POST" >
                                        @csrf
                                        <input type="hidden" name='reply_id' value="{{$reply['id'] ?? ''}}"/>
                                        
                                        <button type='submit' class="w-full text-left">Remove</button>
                                        {{-- {{dd($reply['id'])}} --}}
                                    </form>
                                </li>
                                @else
                                <li class="block px-4 py-2 hover:bg-gray-100">
                                    <button id="{{$reply['id']}}-report-reply" 
                                    data-dropdown-toggle="dropdown-report-reply-{{$reply['id']}}"
                                    type='button'
                                    class="w-full text-left">Report</button>
                                    
                                 </li>
                                @endif
                                
                            </ul>
                        </div>
                        <div id="dropdown-report-reply-{{$reply['id']}}" class="hidden px-2 py-2 bg-white rounded divide-y divide-gray-100 shadow">
                            <form action="{{route('reply.report', $post['id'])}}" method="post" class="max-w-sm mx-auto">
                                @csrf
                                <label for="report" class="block mb-2 text-sm font-medium text-gray-900">Select Type</label>
                                <select id="report" name='type_id' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected>choose</option>
                                    @foreach($reports as $report)
                                        <option value="{{$report['id']}}" >{{$report['name']}}</option>
                                    @endforeach                              
                                </select>
        
                                <input type="hidden" name='reply_id' value='{{$reply['id']}}'/>
                                <div class=" mt-2">
                                    <textarea class="w-full border p-2 rounded-lg" name='message' rows="3" placeholder="please write for the spesific report"></textarea>
                                    <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Message Report</button>
                                </div>
        
                            </form>
                        </div>
                        @else
                        @endif
                        

                    </footer>
                    <p>{{$reply['content']}}</p>
                    <form action="{{route('post.comment.reply', $post['id'])}}" method="post">
                        @csrf
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button"
                                    class="reply-button flex items-center font-medium text-sm text-gray-500 hover:underline"
                                    data-comment-id="reply-{{$reply['id']}}">
                                <svg class="mr-1.5 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                                </svg>
                                Reply
                            </button>
                        </div>
                    
    
                        <!-- Textarea untuk Reply (Disembunyikan Default) -->
                        <input type="hidden" name='comment_id' value='{{$comment['id']}}'/>
                        <div id="reply-form-reply-{{$reply['id']}}" class="hidden mt-2">
                            <textarea class="w-full border p-2 rounded-lg" name='content' rows="3" placeholder="Write a reply..." required>{{'@'.$reply->user->user_name}} </textarea>
                            <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Post Reply</button>
                        </div>

                        
                    </form>
                    
                    <!-- Textarea untuk Reply edit form (Disembunyikan Default) -->
                    <form action="{{route('reply.update', $post['id'])}}" method="post">   
                        @csrf 
                        <input type="hidden" name='reply_id' value='{{$reply['id']}}'/>
                        <div id="reply-form-reply-edit-{{$reply['id']}}" class="hidden mt-2">
                            <textarea class="w-full border p-2 rounded-lg" name='content' rows="3" placeholder=""required>{{$reply['content']}}</textarea>
                            <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Update Reply</button>
                        </div>
                    </form>


                </article>
                
                @else

                @endif

                @endforeach                
            


            
        </article>
        @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.reply-button').forEach(button => {
                button.addEventListener('click', function () {
                    let commentId = this.getAttribute('data-comment-id');
                    let replyForm = document.getElementById('reply-form-' + commentId);
                    replyForm.classList.toggle('hidden'); // Toggle show/hide textarea
                });
            });
        });
    </script>
    </div>
</x-layout>