<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{__('dashboard.attributes.welcome')}}
        </h2>
    </x-slot>

    <div class="h-14">
        <div class="w-full mx-auto">
            <div class="bg-white overflow-hidden shadow-xl h-[85.5vh]">
                <img src="{{ asset('img/dbi.webp') }}" alt = "{{__('dashboard.attributes.imgalt')}}" class="desktop translate-y-[-220px]">
            </div>
        </div>
    </div>
    <div class="h-14">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl">
                <!-- Container for db1 to db5 images -->
                <marquee>
                <div class="flex justify-center items-center ">
                    <a href="#!">
                        <img src="{{ asset('img/db1.webp') }}" alt="{{__('dashboard.attributes.apple')}}" class="w-48"">
                    </a>
                    <a href="#!">
                        <img src="{{ asset('img/db2.png') }}" alt="{{__('dashboard.attributes.deezer')}}" class="w-48 mx-20"">
                    </a>
                    <a href="#!">
                        <img src="{{ asset('img/db3.png') }}" alt="{{__('dashboard.attributes.pandora')}}" class="w-48 mx-20"">
                    </a>
                    <a href="#!">
                        <img src="{{ asset('img/db4.png') }}" alt="{{__('dashboard.attributes.amusic')}}" class="w-48 mx-20"">
                    </a>
                    <a href="https://open.spotify.com/artist/5t28BP42x2axFnqOOMg3CM">
                        <img src="{{ asset('img/db5.png') }}" alt="{{__('dashboard.attributes.spotify')}}" class="w-48 mx-20"">
                    </a>
                </div>
            </marquee>
            </div>
        </div>
    </div>
</x-app-layout>
