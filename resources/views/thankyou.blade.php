<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex  min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full"
                            src="{{$car->image ? asset('storage/' . $car->image) : asset('/img/no-image.png') }}"
                            alt="img" />
                    </div>
                    <div class="">
                        {{$car->id}}
                        Thank you!
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
