<nav class="bg-white border-gray-200 dark:bg-gray-900">

    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">


        <div class="w-1/4 flex items-center space-x-6 rtl:space-x-reverse">
            <a href="tel:5541251234" class="text-sm  text-gray-500 dark:text-white hover:underline">(555) 412-1234</a>
        </div>



        <div class="w-3/4 flex ">
            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false"
                class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>

            <div class="relative hidden md:block w-[80%]">

                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search icon</span>
                </div>

                <input type="text"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search..."
                    id="search-input" autocomplete="off" >

                <div id="dropdownUsers" class="z-1 hidden absolute  bg-white rounded-lg shadow w-[96%] dark:bg-gray-700"
                    style="z-index:999 ">
                    {{-- <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownUsersButton">
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-1.jpg"
                                    alt="Jese image">
                                Jese Leos
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-2.jpg"
                                    alt="Jese image">
                                Robert Gough
                            </a>
                        </li>

                    </ul> --}}
                </div>

            </div>

        </div>

      




        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">

            <div class="relative mt-3 md:hidden">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search-navbar"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search...">


                <div id="dropdownUsers" class="z-1 hidden absolute  bg-white rounded-lg shadow w-[96%] dark:bg-gray-700"
                    style="z-index:999 ">
                    <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownUsersButton">
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-1.jpg"
                                    alt="Jese image">
                                Jese Leos
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-2.jpg"
                                    alt="Jese image">
                                Robert Gough
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-3.jpg"
                                    alt="Jese image">
                                Bonnie Green
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-4.jpg"
                                    alt="Jese image">
                                Leslie Livingston
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-5.jpg"
                                    alt="Jese image">
                                Michael Gough
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-2.jpg"
                                    alt="Jese image">
                                Joseph Mcfall
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-3.jpg"
                                    alt="Jese image">
                                Roberta Casas
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <img class="w-6 h-6 me-2 rounded-full" src="/docs/images/people/profile-picture-1.jpg"
                                    alt="Jese image">
                                Neil Sims
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>


    </div>
</nav>
