@extends('Front.layout.mainlayout')
@section('content')
    @include('Front.Components.breadcrumb')

    <div class="container mx-auto mb-4">
        <div class="flex">

            <div class="w-3/4 mb-4 p-2">
                @include('Front.Checkout.Components.stepper')

                @include('Front.Checkout.Components.tab_content')

            </div>

            <div class="w-1/4 p-2 hidden md:block">
                
                <aside id="separator-sidebar"
                    class="w-full relative top-0 left-0 z-999 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
                    aria-label="Sidebar">
                    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">



                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Product name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Price
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Apple MacBook Pro 17"
                                        </th>
                                        <td class="px-6 py-4">
                                            Silver
                                        </td>
                                    </tr>
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Microsoft Surface Pro
                                        </th>
                                        <td class="px-6 py-4">
                                            White
                                        </td>
                                    </tr>

                                </tbody>

                                <tfoot>
                                    <tr class="font-semibold text-gray-900 dark:text-white">
                                        <th scope="row" class="px-6 py-3 text-base">Total</th>
                                        <td class="px-6 py-3">21,000</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </aside>

                
            </div>

        </div>
    </div>
@endsection
