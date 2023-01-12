<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full"
                            src="{{ $car->image ? asset('storage/' . $car->image) : asset('/img/no-image.png') }}"
                            alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make Reservation</h3>
                            <div>You choose {{ $car->name }}</div>
                            <div class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white"><a
                                    href="{{ route('cars.index') }}">Change car</a></div>
                            <form method="POST" action="{{ route('booking.store') }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="first_name" name="first_name"
                                            value="{{ $booking->first_name ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('first_name')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="last_name" name="last_name"
                                            value="{{ $booking->last_name ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('last_name')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700"> Email
                                    </label>
                                    <div class="mt-1">
                                        <input type="email" id="email" name="email"
                                            value="{{ $booking->email ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('email')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="tel_number" class="block text-sm font-medium text-gray-700"> Phone
                                        number
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="phone" name="phone"
                                            value="{{ $booking->phone ?? '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('phone')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg"
                                        name="coach_id">
                                        @foreach ($coaches as $coach)
                                            <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('coach_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- <div class="sm:col-span-6">
                                    @foreach ($period as $item)
                                        @foreach ($bookings as $booking)
                                           @if ($item->format('d') == date_parse_from_format('Y-m-d', $booking->start_date)['day'])
                                                <p
                                                    class="w-13 px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                                {{ $item->format('j F Y') }}</p>
                                            @else
                                                <p
                                                    class="w-13 px-4 py-2 bg-red-500 hover:bg-indigo-700 rounded-lg text-white">
                                                {{$item->format('j F Y')}}</p>
                                            
                                            @endif
                                        @endforeach
                                    @endforeach
                                    

                                </div> --}}
                                <div class="sm:col-span-6">
                                    <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation
                                        Date
                                    </label>
                                    <div class="mt-1">
                                        <input type="datetime-local" id="start_date" name="start_date"
                                            value="{{ $booking ? $booking->start_date : '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    <span class="text-xs">Please choose the time between 10:00-23:00.</span>
                                    @error('res_date')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <select
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg mb-2"
                                        name="time" id="time">
                                        @for ($i = 1; $i < 6; $i++)
                                            <option value="{{ $i }}">{{ $booking->timeInterval($i) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                {{-- <div class="sm:col-span-6">
                                    <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation
                                        Date
                                    </label>
                                    <div class="mt-1">
                                        <input type="datetime-local" id="start_date" name="start_date"
                                            min="{{ $min_date->format('Y-m-d\TH:i:s') }}"
                                            max="{{ $max_date->format('Y-m-d\TH:i:s') }}"
                                            value="{{ $booking ? $booking->start_date : '' }}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    <span class="text-xs">Please choose the time between 17:00-23:00.</span>
                                    @error('start_date')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                        </div>
                        <div class="mt-6 p-4 flex justify-between">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Make reserve</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</x-guest-layout>
