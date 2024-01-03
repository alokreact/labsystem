@extends('Front.layout.mainlayout')
@section('content')
    <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    @include('Front.Components.breadcrumb')

    <div class="container mx-auto flex">
        @include('Front.Search.Components.sidebar')

        <div class="p-4 sm:ml-4 w-full md:w-2/3">
            <div class="flex flex-wrap p-2 justify-between flex-col md:flex-row">
                @forelse ($subtests as $test)
                    <div
                        class="w-full md:w-[23%] max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-2">
                        <div class="items-end ps-3 p-2">
                            <input id="vue-checkbox-list" type="checkbox" name="test[]" value="{{ $test->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 test_id">
                        </div>

                        <a href="#"><img class="p-8 rounded-t-lg" src="{{ asset('Image/' . $testsbyOrgan['image']) }}"
                                alt="product image" /></a>

                        <div class="px-5 pb-5 flex items-center justify-center">
                            <a href="#">
                                <h5 class="text-xs font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ ucfirst($test->sub_test_name) }}</h5>
                            </a>
                        </div>
                    </div>
                @empty
                
                @endforelse
            </div>

            <nav aria-label="Page navigation example">
                <ul class="flex items-center -space-x-px h-8 text-sm justify-end">
                    <li>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
@endsection
