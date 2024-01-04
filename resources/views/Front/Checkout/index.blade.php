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

@push('after-scripts')
    <script>
        $(".nextTab").on('click', function(e) {
            e.preventDefault();

            var currentTab = $(this).val();

            if (currentTab === "1") {
                var errors = [];
                var address = $('input[name="address"]:checked').val();

                if (!address) {
                    errors.push('Please select an Address.');
                }

                if (errors.length > 0) {
                    var errorHtml = '<ul>';
                    errors.forEach(function(error) {
                        errorHtml += '<li>' + error + '</li>';
                    });
                    errorHtml += '</ul>';
                    Swal.fire({
                        icon: 'error',
                        html: errorHtml,
                    });
                } else {
                    $('#dashboard-tab').removeAttr('disabled');
                    $('#dashboard-tab').click();

                }
            }
        });
        $('#pateint_tab_forward_btn').on('click', function(e) {
            e.preventDefault();

            var btnVal = $(this).val();

            if (btnVal === "2") {

                var errors = [];
                var patient = $('input[name="patient[]"]:checked').val();

                if (!patient) {
                    errors.push('Please select an Patient.');
                }
                if (errors.length > 0) {
                    var errorHtml = '<ul>';
                    errors.forEach(function(error) {
                        errorHtml += '<li>' + error + '</li>';
                    });
                    errorHtml += '</ul>';

                    Swal.fire({
                        icon: 'error',
                        html: errorHtml,
                    });

                } else {
                    $('#settings-tab').removeAttr('disabled');
                    $('#settings-tab').click()
                }
            }
        });

        $('#slot_tab_forward_btn').on('click', function(e) {
            var btnVal = $(this).val();
            if (btnVal === 3) {
            
                var errors = [];
                var slot_day = $('input[name="slot_day"]:checked').val();
                var slot_time = $('input[name="slot_time"]:checked').val();

                if (!slot_day) {
                    errors.push('Please select a Date.');
                }
                if (!slot_time) {
                    errors.push('Please select a Time.');
                }
                if (errors.length > 0) {
                    var errorHtml = '<ul>';
                    errors.forEach(function(error) {
                        errorHtml += '<li>' + error + '</li>';
                    });
                    errorHtml += '</ul>';
                    Swal.fire({
                        icon: 'error',
                        html: errorHtml,
                    });
                } else {
                    // nextTab = currentTab + 3;
                    // console.log('>>>>nextTab', currentTab)
                    // console.log('>>>>nextTab', nextTab)
                    // showTab(nextTab);
                }
            }
        });
    </script>
@endpush
