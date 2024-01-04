@include('Front.utils.svg')

<div id="default-tab-content">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
        aria-labelledby="profile-tab">

        <div class="flex flex-col md:flex-row p-2">

            @forelse($addresses as $address)
                <div class="w-full md:w-1/3 border flex flex-col mt-2 mr-2">
                    <div class="border-b-2 w-full p-3 flex justify-between">
                        <h3 class="text-black text-base font-semibold">{{ ucfirst($address->name) }}</h3>
                        <div class="items-end ps-3">

                            <input name="address" id="address" type="radio" value="{{ $address->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                    </div>

                    <div class="w-full p-3">
                        <address>
                            <h3 class="text-black text-base font-semibold"> Address: </h3>
                            <p> {{ ucfirst($address->address1) }}</p>
                            <span>{{ ucfirst($address->city) }}, {{ ucfirst($address->state) }},
                                {{ ucfirst($address->zip) }}
                        </address>
                    </div>

                    <div class="w-full p-2">
                        <h3 class="text-black text-base font-semibold">Phone: +91-{{ $address->phone }}</h3>
                    </div>

                    <div class="w-full p-2">
                        <h3 class="text-black text-base font-semibold">Email: {{ $address->email }}</h3>
                    </div>

                    <div class="w-full flex justify-between p-2">
                        <a href="#">
                            <button
                                class="border p-2 text-black border-green-400 hover:bg-green-400  hover:text-white mr-2"
                                type="button"><i class="icofont-edit"></i></button>
                        </a>
                        <button class="p-2 border remove_address_btn" type="button"><i
                                class="icofont-ui-delete"></i></button>
                    </div>
                </div>

            @empty
            @endforelse

        </div>
        
        <div class="w-full flex justify-end  items-center flex-shrink-0 p-2">
            <div class="flex items-center flex-shrink-0">

                <button type="button"
                    class="inline-flex items-center justify-center px-3 py-2 me-3 ml-2 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br 
                focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center 
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 nextTab"
                    value="1">

                    Next

                    <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>

                </button>
            </div>
        </div>


    </div>


    @include('Front.Checkout.Components.patient')

    @include('Front.Checkout.Components.slot')

    @include('Front.Checkout.Components.payment')

</div>
