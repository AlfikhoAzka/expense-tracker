<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Expense') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-md sm:text-center">
            <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl dark:text-white">Sign up for our newsletter</h2>
            <p class="mx-auto mb-8 max-w-2xl font-light text-gray-500 md:mb-12 sm:text-xl dark:text-gray-400">Stay up to date with the roadmap progress, announcements and exclusive discounts feel free to sign up with your email.</p>
            <form action="#">
                <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                    <div class="relative w-full">
                        <label for="email" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                        </div>
                        <input class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter your email" type="email" id="email" required="">
                    </div>
                    <div>
                        <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Subscribe</button>
                    </div>
                </div>
                <div class="mx-auto max-w-screen-sm text-sm text-left text-gray-500 newsletter-form-footer dark:text-gray-300">We care about the protection of your data. <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Read our Privacy Policy</a>.</div>
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