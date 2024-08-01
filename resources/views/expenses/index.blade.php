<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Expense') }}
        </h2>
    </x-slot>
    
    <div class="py-0 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mx-auto max-w-screen-md sm:text-left">
            <form action="#">
                <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                    <div class="relative w-full">
                        <input class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search..." type="name" id="name">
                    </div>
                    <div>
                        <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="py-12 bg-gradient-to-r from-indigo-600 to-pink-500">
        <div class="py-0 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-x-auto shadow-md sm:rounded-lg mb-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-2/4">Name
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/4">Price
                            </th>
                            <th scope="col" class="px-6 py-3 ">Created at
                            </th>
                            <th
                                scope="col" class="px-6 py-3 ">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr class="bbg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row"class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$expense ->name}}
                            </td>
                            <td scope="row"class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Rp,{{$expense ->price}}
                            </td>
                            <td scope="row"class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$expense ->created_at}}
                            </td>
                            <td class="px-6">
                                <div class="flex space-x-2">
                                    <a href="{{ route('expenses.edit', $expense->id ) }}" class="bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl text-white shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-bold py-2 px-4 rounded">Edit</a>
                                    <form action="{{ route('expenses.destroy', $expense->id ) }} "method="POST" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl text-white shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-bold py-2 px-4 rounded">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $expenses->links() }}
        </div>
    </div>
</x-app-layout>