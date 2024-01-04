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
            <div class="flex flex-wrap p-2 justify-between flex-column md:flex-row">
                <h3 class="text-md">{{ ucfirst($package['package_name']) }}</h3>

                <div class="divider my-4"></div>

                <p class="lead">{{ $package['package_desc'] }}</p>
                <h3 class="mt-5 mb-4">Tests</h3>
                <div class="divider my-4"></div>



                <div id="accordion-color" data-accordion="collapse"
                    data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">

                    @foreach ($package['grouptest'] as $parenttest)

                        <h2 id="desc{{ $parenttest['id'] }}">

                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
                                data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                                aria-controls="accordion-color-body-1">
                                <span>{{ ucfirst($parenttest['name']) }}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>

                        <div id="desc{{ $parenttest['id'] }}" class="hidden" aria-labelledby="accordion-color-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <ul class="list-unstyled department-service">
                                    @foreach ($parenttest['subtest'] as $subtest)
                                        <li>
                                            <i class="icofont-check mr-2"></i>
                                            {{ $subtest['sub_test_name'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>
@endsection
