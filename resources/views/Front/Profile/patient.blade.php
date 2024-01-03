@extends('Front.layout.mainlayout')
@section('content')
    @include('Front.Components.breadcrumb')
    <div class="container mx-auto flex">
        @include ('Front.Profile.Components.Sidebar')

        <div class="p-4  w-3/4">
            <nav class="border-gray-200 bg-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <div class="text-center flex justify-between w-full">
                        <h2 class="text-xl">Family Members</h2>
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            type="button" data-drawer-target="drawer-contact" data-drawer-show="drawer-contact"
                            aria-controls="drawer-contact">
                            Add Members
                        </button>
                    </div>
                    <!-- drawer component -->
                    @include('Front.Profile.Forms.add_patient')
                </div>
            </nav>




            <div class="flex flex-col md:flex-row p-2">
                    <div class="w-full md:w-1/3 border flex flex-col mt-2 mr-2">
                        <div class="border-b-2 w-full p-3 flex justify-between">
                            <h3 class="text-black text-base font-semibold">Name: 
                                <span>Rajbanshi Singh</span>
                            </h3>
                            <div class="items-end ps-3">
                                <input id="vue-checkbox-list" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            </div>
                        </div>

                        <div class="w-full p-2">
                            <h3 class="text-black text-base font-semibold">Age - 22</h3>
                        </div>
            
                        <div class="w-full p-2">
                            <h3 class="text-black text-base font-semibold">Gender - Male
                            </h3>
                        </div>
            
                        <div class="w-full flex justify-between p-2">
                            <a href="#">
                                <button class="p-2 border text-black border-green-400 hover:bg-green-400  hover:text-white mr-2"
                                    type="button"><i class="icofont-edit"></i></button>
                            </a>
                            <button class="p-2 border delete_patient" type="button" value="">
                                <i class="icofont-ui-delete"></i></button>
                        </div>
            
                    </div>
            </div>
            
        </div>
    </div>
@endsection
