<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-indigo-600 to-pink-500">
        <div class="py-0 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-x-auto shadow-md sm:rounded-lg mb-4">
                <form method="POST" action="{{ route('categories.update', $category->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="p-6 bg-white dark:bg-gray-800 space-y-6">
                        <div class="grid grid-cols-1">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class=" mt-1 block w-full" value="{{ $category->name }}" required autocomplete="name"/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="flex justify-between items-center mt-4">
                                <a href="/categories" class="bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl text-white shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-bold py-2 px-4 rounded">Cancel</a>
                            <button type="submit" class="bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl text-white shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-bold py-2 px-4 rounded">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

