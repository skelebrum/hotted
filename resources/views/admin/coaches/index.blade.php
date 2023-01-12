<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.coaches.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    New coach
                </a>
            </div>
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Age
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Status
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Photo
                            </th>
                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless($coaches->isEmpty())


                            @foreach ($coaches as $coach)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $coach->name }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $coach->age }}
                                    </td>
                                    <td class="py-4 px-6 text-green-500">
                                        {{ $coach->status }}
                                    <td>
                                        <img class="hidden w-20 mr-6 md:block"
                                            src="{{ $coach->photo ? asset('storage/coaches/' . $coach->photo) : asset('/img/no-image.png') }}"
                                            alt="" />
                                    </td>
                                    <td class="py-4 px-6 text-sm">
                                        <div class="flex">
                                            <a href="{{ route('admin.coaches.edit', $coach->id) }}"
                                                class="px-2 py-1 mr-3 mb-3  bg-green-700 hover:bg-green-900 rounded-lg text-white">Edit</a>
                                            <form class="px-2 py-1 mb-3 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                onsubmit="return confirm('Are you sure?')" method="POST"
                                                action="{{ route('admin.coaches.destroy', $coach->id) }} ">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                </div>

                </tr>
                @endforeach
            @else
                <div>
                    <h3>List is empty</h3>
                </div>
            @endunless
            </tbody>
            </table>
        </div>
    </div>
    </div>
    <x-flash-message />
</x-admin-layout>
