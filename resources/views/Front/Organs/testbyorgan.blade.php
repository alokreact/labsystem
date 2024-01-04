@extends('Front.layout.mainlayout')
@section('content')
    <div id="loader"
        class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-75 flex justify-center items-center z-50 hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-12 w-12"></div>
    </div>

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

        <div class="p-4 ml-4 md:ml-20 w-full md:w-2/3">
            <div class="flex p-1 my-2 w-full" id="count_result">
                <span id="badge-dismiss-green"
                    class="inline-flex items-center px-2 py-1 me-2  text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">
                    Showing {{ count($subtests) }} results
                </span>

                <div class="flex justify-end w-[85%]">

                    <button
                        class="border border-green-500 w-[120px]  rounded-full p-2 text-black hover:scale-110 hover:bg-green-500 hover:text-white search_multiple_test_btn">Check
                        Now</button>
                </div>
            </div>
            <div class="flex flex-wrap p-2 justify-between flex-col md:flex-row" id="searchResult">
                @forelse ($subtests as $test)
                    <div
                        class="w-full md:w-[23%] max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-2">
                        <div class="items-end ps-3 p-2">
                            <input id="vue-checkbox-list" type="checkbox" name="test[]" value="{{ $test->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 test_id">
                        </div>

                        <a href="#">
                            <img class="p-8 rounded-t-lg" src="{{ asset('Image/' . $testsbyOrgan['image']) }}"
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
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).on('click', '.search_multiple_test_btn', function() {
            var checkBoxValue = [];
            $('input[name="test[]"]:checked').each(function() {
                checkBoxValue.push($(this).val());
            });
            if (checkBoxValue.length < 1) {
                alert('Please select tests');
                return;
            }
            $('#loader').removeClass('hidden');

            $.ajax({
                url: APP_URL + '/search/multipletest',
                data: {
                    checkBoxValue
                },
                method: 'POST',
                success: function(response, textStatus, xhr) {
                    var testDiv = '';
                    var searchDiv = '';
                    if (xhr.status === 200) {
                        $.each(response.tests, function(index, data) {
                            var imageName = APP_URL + '/Image/' + data.image;
                            //console.log('imageName',imageName)
                            testDiv +=
                                '<div class="w-[32%] max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-2"><a href="#">';
                            testDiv += '<img class="p-8 rounded-t-lg" src=" ' + imageName +
                                ' " alt="product image" /></a>';

                            testDiv += '<div class="px-5 pb-5"><a href="#">';
                            testDiv +=
                                '<h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">';
                            testDiv +=
                                '<i class="icofont-google-map" style="font-size:16px;color:#000"></i>Hyderabad</h5>';
                            testDiv += '</a>';
                            testDiv += '<div class="flex items-center justify-between mt-2">';
                            testDiv +=
                                '<span class="text-3xl font-bold text-gray-900 dark:text-white">₹' +
                                data.total_price + '/-</span>';
                            testDiv +=
                                '<button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 btn_add_to_cart_test" value="' +
                                data.test_ids + '" data-type="test" data-lab="' + data.lab_id +
                                '"';
                            testDiv += 'data-price="' + data.total_price + '"';
                            testDiv += 'data-singleprice="' + data.single_price + '">';

                            testDiv += 'Add to cart</button>';
                            testDiv += '</div>';
                            testDiv += '</div></div>';
                        })

                        $.each(response.searchTerms.name, function(index, data) {
                            var id = response.searchTerms.id[index];
                            var count = 45;

                            var result = data.slice(0, count) + (data.length > count ? "..." :
                                "");
                            searchDiv +=
                                '<span id="badge-dismiss-green" class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">';
                            searchDiv += result +
                                '<button type="button" class="remove_search_btn inline-flex items-center p-1 ms-2 text-sm text-green-400 bg-transparent rounded-sm hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-300"  data-id="' +
                                id + '">';
                            searchDiv +=
                                '<svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
                            searchDiv +=
                                ' <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
                            searchDiv += '</svg>';
                            searchDiv += '<span class="sr-only">Remove badge</span>';
                            searchDiv += '</button>';
                            searchDiv += '</span>';
                        });
                        $('#loader').addClass('hidden');
                        $('#searchResult').html(testDiv);
                        $('#test_header').hide();
                        $('#count_result').html(searchDiv);
                    }
                }
            })
    })

    $(document).on('click', '.remove_search_btn',function() {
        $('#loader').removeClass('hidden');
        var testId = $('.remove_search_btn').attr('data-id');
        var dataAttributes = [];
        $('.remove_search_btn').each(function () {
            // Get data attributes for each element
            var id = $(this).attr('data-id');
            dataAttributes.push({
                id: id
            });
        });
        if (dataAttributes.length === 1) {
            window.location.reload();
            return;
        }
        dataArray = $.grep(dataAttributes, function (item) {
            return item.id !== testId;
        });
        $.ajax({
            url: APP_URL + '/remove/multipletest',
            method: 'POST',
            data: { dataArray },
            success: function (response, textStatus, xhr) {

                var testDiv = '';
                var searchDiv = '';

                if (xhr.status === 200) {
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
                        testDiv += '<button class="w-[120px]  border-green-500 text-green-500 rounded-full border p-2 hover:bg-green-500 hover:text-white btn_add_to_cart_test" value="+data.id+" data-type="test" data-lab="+data.lab_id+"';
                        testDiv += 'data-price="+data.total_price+"';
                        testDiv += 'data-singleprice="+data.single_price+">';
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

                    $('#loader').addClass('hidden');
                    $('#organResult').hide();
                    $('#searchResult').html(testDiv);
                    $('#chipResult').html(searchDiv);
                }
            }
        })
    })
    </script>
@endpush
