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

            <div class="flex justify-between p-1 my-2 w-full" id="count_result">

                <span id="badge-dismiss-green"
                    class="inline-flex items-center px-2 py-1 me-2 
                text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">
                    Showing {{ count($subtests) }} results
                </span>

                <button
                    class="border border-green-500 w-[120px]  rounded-full p-2 text-black hover:scale-110 hover:bg-green-500 hover:text-white search_multiple_test_btn">Check
                    Now</button>

            </div>

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

@push('after-scripts')
<script>

$(document).on('click', '.search_multiple_test_btn', function () {
    var checkBoxValue = [];

    $('input[name="test[]"]:checked').each(function () {
        checkBoxValue.push($(this).val());
    });
    console.log('checkBoxValue', checkBoxValue.length)

    if (checkBoxValue.length < 1) {
        alert('Please select tests');
        return;
    }
    $('#loader').removeClass('hidden');

    $.ajax({
        url: APP_URL + '/search/test',
        data: { checkBoxValue },
        method: 'POST',
        success: function (response, textStatus, xhr) {
            var testDiv = '';
            var searchDiv = '';
            if (xhr.status === 200) {

                console.log('>>>',response);return;

                $.each(response.tests, function (index, data) {
                    var imageName = APP_URL + '/Image/' + data.image;
                    //console.log('imageName',imageName)
                    testDiv += '<div class="w-full md:w-[31%] mb-4 border mx-2">';
                    testDiv += '<div class="border-b-2 rounded w-[260px] h-[144px] p-3 mx-auto">';
                    testDiv += ' <img src=" ' + imageName + ' "/>';
                    testDiv += '</div>';

                    testDiv += '<div class="p-4 mt-2 items-center flex justify-between">';
                    testDiv += '<h6 class="text-black text-basic font-semibold mb-2">';
                    testDiv += '<i class="icofont-google-map" style="font-size:16px;color:#000"></i>Hyderabad</h6>';
                    testDiv += '<button class="w-[120px]  border-green-500 text-green-500 rounded-full border p-2 hover:bg-green-500 hover:text-white btn_add_to_cart_test" value="' + data.test_ids + '" data-type="test" data-lab="' + data.lab_id + '"';
                    testDiv += 'data-price="' + data.total_price + '"';
                    testDiv += 'data-singleprice="' + data.single_price + '">';
                    testDiv += 'Add To Cart</button></div>';
                    testDiv += ' <div class="p-3 mt-1 mb-1 items-center bg-gray-100 flex justify-between my-1 mx-1 rounded-full text-black">';
                    testDiv += '<del>₹<span>' + data.total_price * 2 + '/-</span></del>';
                    testDiv += '<span>₹' + data.total_price + '/-</span>';
                    testDiv += '<div class="sm">50% discount </div>';
                    testDiv += '</div> </div>';
                })

                $.each(response.searchTerms.name, function (index, data) {

                    var id = response.searchTerms.id[index];
                    var count = 45;

                    var result = data.slice(0, count) + (data.length > count ? "..." : "");

                    searchDiv += '<span class="ml-2 p-2 chip">';
                    searchDiv += result +
                        '<i class="icofont-close-line-squared-alt remove_search_btn text-xl p-1 mb-1" data-id="' + id +
                        '"></i></span>';

                 });

                $('#count_result').hide();
                $('#organResult').hide();
                $('#loader').addClass('hidden');
                $('#searchResult').html(testDiv);
                $('#test_header').hide();
                $('#searchBreadcumb').removeClass('hidden');
                $('#chipResult').html(searchDiv);
            }
        }
    })
})
    </script>

    @endpush