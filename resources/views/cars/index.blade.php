<x-guest-layout>
    @include('partials._hero')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @if (count($cars) == 0)
            <p>No cars</p>
        @endif
        @foreach ($cars as $car)
            <x-car-card :car="$car" />
        @endforeach

    </div>

    <div class="mt-6 p-4">
        {{ $cars->links() }}
    </div>
</x-guest-layout>
