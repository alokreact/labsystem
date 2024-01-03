<div id="default-tab-content">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
        aria-labelledby="profile-tab">

        <div class="flex flex-col md:flex-row p-2">

            <div class="w-full md:w-1/3 border flex flex-col mt-2 mr-2">
                <div class="border-b-2 w-full p-3 flex justify-between">
                    <h3 class="text-black text-base font-semibold">Harshit Agarawal</h3>

                    <div class="items-end ps-3">
                        <input id="vue-checkbox-list" type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    </div>
                </div>
                <div class="w-full p-3">
                    <address>
                        <h3 class="text-black text-base font-semibold"> Address: </h3>
                        <p> Kondapur</p>
                        <span>Hyderabad, Telengana,
                            500084
                    </address>
                </div>

                <div class="w-full p-2">
                    <h3 class="text-black text-base font-semibold">Phone: +91-989788888</h3>
                </div>

                <div class="w-full p-2">
                    <h3 class="text-black text-base font-semibold">Email: alok@gmail.com</h3>
                </div>

                <div class="w-full flex justify-between p-2">

                    <a href="#">
                        <button class="border p-2 text-black border-green-400 hover:bg-green-400  hover:text-white mr-2"
                            type="button"><i class="icofont-edit"></i></button>
                    </a>

                    <button class="p-2 border remove_address_btn" type="button"><i
                            class="icofont-ui-delete"></i></button>
                </div>
            </div>

        </div>

        <button type="button"
            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center 
          dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            value="1" id="nextTab">Next</button>
    </div>

    
    
    @include('Front.Checkout.Components.patient')

    @include('Front.Checkout.Components.slot')

    @include('Front.Checkout.Components.payment')

</div>
