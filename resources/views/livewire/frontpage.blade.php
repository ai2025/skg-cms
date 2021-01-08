<div class="divide-y divide-gray-800" x-data="{ show: false }">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <nav class="flex items-center bg-gray-900 px-3 py-2 shadow-lg">
        <div>
            <button @click="show =! show" class="block h-8 mr-3 text-gray-400 items-center hover:text-gray-200 focus:text-gray-200 focus:outline-none sm:hidden">
                <svg class="w-8 fill-current" viewBox="0 0 24 24">                            
                    <path x-show="!show" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                    <path x-show="show" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
        <div class="h-12 w-full flex items-center">
            <a href="{{ URL('/') }}" class="w-full">
                <img class="h-8" src="{{ URL('/img/logo.svg') }}" alt="NONE">
            </a>
        </div>
        <div class="flex justify-end sm:w-8/12">
            {{-- Top Nav Links --}}
            <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                @foreach ($topNavLinks as $item)
                    <a href="{{ url('/'.$item->slug) }}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                    </a>
                @endforeach
                {{-- <a href="{{ url('/login') }}">
                    <li class="cursor-pointer px-4 py-2 hover:underline">Login</li>
                </a> --}}
            </ul>
        </div>
    </nav>
    <div class="sm:flex sm:min-h-screen">
        <aside class="bg-gray-900 text-gray-700 divide-y divide-gray-600 divide-dashed 
        sm:w-4/12 md:w-3/12 lg:w-2/12">
            {{-- Desktop view --}}
            <ul class="hidden text-gray-200 text-xs sm:block
            sm:text-left">

                @foreach ($sidebarLinks as $item)
                    <a href="{{ url('/'.$item->slug) }}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                    </a>
                @endforeach

                {{-- <a href="{{ url('/home') }}">
                    <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">Home</li>
                </a>
                <a href="{{ url('/about') }}">
                    <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">About</li>
                </a>
                <a href="{{ url('/contact') }}">
                    <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">Contact</li>
                </a> --}}
            </ul>

            {{-- mobile view --}}
            <div :class="show ? 'block' : 'hidden'" class="pb-3 divide-y divide-gray-800 block sm:hidden">
                <ul class="text-gray-200 text-xs">
                    @foreach ($sidebarLinks as $item)
                        <a href="{{ url('/'.$item->slug) }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                        </a>
                    @endforeach
                </ul>

                {{-- top nav mobile web view --}}
                <ul class="text-gray-200 text-xs">
                    @foreach ($topNavLinks as $item)
                        <a href="{{ url('/'.$item->slug) }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </aside>
        <main class="bg-gray-100 p-12 min-h-screen sm:w-8/12 md:w-9/12 lg:w-10/12">
            <section class="divide-y text-gray-900">

                {{-- <button 
                    @click="showText = true"
                    class="bg-green-500 p-3 text-white"
                >
                    Show
                </button>
                <button 
                    @click="showText = false;"
                    :class="showText ? 'bg-red-900' : 'bg-yellow-500'"
                    class="bg-gray-500 p-3 text-white mb-4"
                    >
                        Hide
                </button>

                <div x-show="showText">true</div>
                <div x-show="!showText">false</div>

                <div x-text="randomVar"></div> --}}

                {{-- <div x-text="show == true ? 'True' : 'False'"></div> --}}
                <h1 class="text-3xl font-bold">{{ $title }}</h1>
                <article>
                    <div class="mt-5 text-sm">
                        {!! $content !!}
                    </div>
                </article>
            </section>
        </main>
    </div>
</div>
