@extends('Front.layout.mainlayout')
@section('content')
    @include('Front.Components.breadcrumb')
    <div class="container mx-auto flex justify-between">

        @include ('Front.Profile.Components.Sidebar')

        <div class="p-1  w-3/4">

            <nav class="border-gray-200 bg-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

                    <!-- drawer init and show -->
                    <div class="text-center">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            type="button" data-drawer-target="drawer-contact" data-drawer-show="drawer-contact"
                            aria-controls="drawer-contact">
                            Add Address
                        </button>
                    </div>

                    <!-- drawer component -->
                    @include('Front.Profile.Forms.add_address')

                </div>
            </nav>
        </div>
    </div>
@endsection
