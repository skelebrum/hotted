<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$car->image ? asset('storage/' . $car->image) : asset('/img/no-image.png')}}"
            alt=""/>
        <div>
            <h3 class="text-2xl">
                <a href="/cars/{{$car['id']}}">{{$car->name}}</a>
                </h3>

                <form action="{{route('booking.store.car')}}" method="POST">
                    @csrf
                    <input type="hidden" name='car_id' value="{{$car->id}}">
                    <button class="px-4 py-2 bg-red-500 hover:bg-indigo-700 rounded-lg text-white" 
                    type="submit" >Book now</button>
                </form>
            </div>
        </div>
</x-card>