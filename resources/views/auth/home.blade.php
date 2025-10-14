<x-layout>
        @auth
                <p>Welcome, {{ auth()->user()->username }}</p>
        @endauth


        User home page
</x-layout>
