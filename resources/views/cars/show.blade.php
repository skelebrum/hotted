<x-guest-layout>
        <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <div class="mx-4">
            <x-card class="p-10">
                <div class="flex flex-col items-center justify-center text-center">
                    <img class="w-48 mr-6 mb-6"
                        src="{{ $car->image ? asset('storage/' . $car->image) : asset('/img/no-image.png') }}">

                    <h3 class="text-2xl mb-2">
                        {{ $car->name }}
                    </h3>
                    <div class="border border-gray-200 w-full mb-6"></div>
                    <div>
                        <div class="text-lg space-y-6">
                            <p>
                                {{ $car->description }}
                            </p>
                        </div>
                        <div>{{$car->top_speed}}</div>
                        <div>{{$car->power}}</div>
                        <div>{{$car->drivetrain}}</div>
                        <div>{{$car->price}}</div>
                        <div class="text-xl mt-4  mb-2">
                            <button class="px-4 py-2 bg-red-500 hover:bg-indigo-700 rounded-lg text-white"><a href="{{route('booking.store.car')}}">Book Now</a></button>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
</x-guest-layout>
