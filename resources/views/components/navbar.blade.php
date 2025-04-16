<nav x-data="{ isOpenMobile: false, isOpenDropdown: false }" class="bg-gray-800">
  <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex items-center space-x-2">
                <img class="size-10" src="{{ asset('storage/Goblog-4.png') }}" alt="GoBlog Logo">
                <p class="text-lg font-bold text-white">GoBlog</p>
            </div>
            
              <div class="hidden md:block">
                  <div class="ml-10 flex items-baseline space-x-4">
                      <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                      <x-nav-link href="/posts" :active="request()->is('posts')">Blog</x-nav-link>
                      <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
                      <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                      @auth
                        @if(!Auth::user()->is_admin)
                            <x-nav-link href="/dashboard" :active="request()->is('dashboard')">Dashboard</x-nav-link>
                        @else
                            <x-nav-link href="{{route('filament.admin.pages.dashboard')}}" :active="request()->is('dashboard')">Dashboard</x-nav-link>
                        @endif
                      @endauth
                  </div>
              </div>
          </div>
          <div class="hidden md:block">
              <div class="ml-4 flex items-center md:ml-6">
        
                  @auth
                  <div class="relative ml-3" x-data="{ isOpenDropdown: false }">
                      <button @click="isOpenDropdown = !isOpenDropdown" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-none">
                          <img class="size-8 rounded-full" 
                          src="{{ asset('/storage/'. Auth::user()->image) }}" alt="">
                      </button>
                      <div x-show="isOpenDropdown" x-transition class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none">
                          <a href="/profile" class="block px-4 py-2 text-sm text-gray-700">Edit Profile</a>
                          <form action="/logout" method="POST">
                              @csrf
                              <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700">Sign out</button>
                          </form>
                      </div>
                  </div>
                  @else
                  <x-nav-link href="/login" :active="request()->is('login')">Login</x-nav-link>
                  @endauth
              </div>
          </div>
          <div class="-mr-2 flex md:hidden">
              <button @click="isOpenMobile = !isOpenMobile" type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-none">
                  <span class="sr-only">Open main menu</span>
                  <svg :class="{'hidden': isOpenMobile, 'block': !isOpenMobile }" class="block size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M3 6h18M3 12h18m-18 6h18" />
                  </svg>
                  <svg :class="{'block': isOpenMobile, 'hidden': !isOpenMobile }" class="hidden size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M6 18L18 6M6 6l12 12" />
                  </svg>
              </button>
          </div>
      </div>
  </div>
  <div x-show="isOpenMobile" class="md:hidden">
      <div class="space-y-1 px-2 pt-2 pb-3">
          <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
          <x-nav-link href="/posts" :active="request()->is('posts')">Blog</x-nav-link>
          <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
          <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
          @auth
            @if(!Auth::user()->is_admin)
                <x-nav-link href="/dashboard" :active="request()->is('dashboard')">Dashboard</x-nav-link>
            @else
                <x-nav-link href="{{route('filament.admin.pages.dashboard')}}" :active="request()->is('dashboard')">Dashboard</x-nav-link>
            @endif
          @else
          <x-nav-link href="/login" :active="request()->is('login')">Login</x-nav-link>
          @endauth

          @auth
          <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="flex items-center px-5">
              <div class="shrink-0">
                <img class="size-10 rounded-full" src="{{ asset('/storage/'. Auth::user()->image) }}" alt="">
              </div>
              <div class="ml-3">
                <div class="text-base/5 font-medium text-white">{{Auth::user()->name}}</div>
                <div class="text-sm font-medium text-gray-400">{{Auth::user()->email}}</div>
              </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
              <a href="/profile" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Edit Profile</a>
              <form action="/logout" method="POST">
                @csrf
              <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</button>
              </form>
            </div>
          </div>
          @endauth

      </div>
  </div>
</nav>
