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
            <div class="flex flex-wrap p-2" id="testChip"></div>
            <div class="flex flex-wrap p-2 justify-between flex-column md:flex-row" id="searchHaederResult">
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        var urlParams = new URLSearchParams(window.location.search);
        console.log('appendedData', urlParams)

        var appendedData = urlParams.get('data');
        var newItem = appendedData; // Replace with the value you want to add
        var existingData = localStorage.getItem('testArr');
        // If the key doesn't exist, create an empty array
        var testArr = existingData ? JSON.parse(existingData) : [];
        console.log('testArr', testArr)

        if (!testArr.includes(newItem)) {
            testArr.push(newItem);
            // Save the updated array back to local storage
            localStorage.setItem('testArr', JSON.stringify(testArr));
        }
        $.ajax({
            'url': APP_URL + '/search/labs',
            'data': {
                test_id: testArr
            },
            'method': 'POST',
            success: function(response, textStatus, xhr) {
                var testDiv = '';
                var searchDiv = '';
                if (xhr.status === 200) {

                    $.each(response.tests, function(index, data) {
                        var imageName = APP_URL + '/Image/' + data.image;
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
                        testDiv += '<span class="text-3xl font-bold text-gray-900 dark:text-white">₹' +
                            data.total_price + '/-</span>';
                        testDiv +=
                            '<button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 btn_add_to_cart_test" value="' +
                            data.test_ids + '" data-type="test" data-lab="' + data.lab_id + '"';
                        testDiv += 'data-price="' + data.total_price + '"';
                        testDiv += 'data-singleprice="' + data.single_price + '">';

                        testDiv += 'Add to cart</button>';
                        testDiv += '</div>';
                        testDiv += '</div></div>';
                    })

                    $.each(response.searchTerms.name, function(index, data) {
                        var id = response.searchTerms.id[index];
                        var count = 45;

                        var result = data.slice(0, count) + (data.length > count ? "..." : "");

                        searchDiv +=
                            '<span id="badge-dismiss-green" class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">';
                        searchDiv += result +
                            '<button type="button" class="close_search_btn inline-flex items-center p-1 ms-2 text-sm text-green-400 bg-transparent rounded-sm hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-300"  data-id="' +
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
                    $('#searchHaederResult').html(testDiv);
                    //$('#searchBreadcumb').removeClass('hidden');
                    $('#testChip').html(searchDiv);
                }
            }
        })
        $(document).on('click', '.close_search_btn', function() {

            console.log('>>>close')
            $('#loader').removeClass('hidden');
            var testId = $(this).attr('data-id');
            var existingData = localStorage.getItem('testArr');

            var dataArray = JSON.parse(existingData);
            if (dataArray.includes(testId)) {
                let indexToRemove = dataArray.indexOf(testId);

                if (indexToRemove !== -1) {
                    dataArray.splice(indexToRemove, 1);
                }
                // Save the updated array back to local storage
                localStorage.setItem('testArr', JSON.stringify(dataArray));
            }
            if (dataArray.length < 1) {
                window.location.href = APP_URL;
                return;
            } else {
                $.ajax({
                    url: APP_URL + '/remove-test',
                    method: 'POST',
                    data: {
                        dataArray
                    },
                    success: function(response, textStatus, xhr) {
                        var testDiv = '';
                        var searchDiv = '';

                        if (xhr.status === 200) {
                            $.each(response.tests, function(index, data) {
                                var imageName = APP_URL + '/Image/' + data.image;
                                testDiv +=
                                    '<div class="w-full md:w-[32%] max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-2"><a href="#">';
                                testDiv += '<img class="p-8 rounded-t-lg" src=" ' + imageName +
                                    ' " alt="product image" /></a>';

                                testDiv += '<div class="px-5 pb-5"><a href="#">';
                                testDiv +=
                                    '<h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">';
                                testDiv +=
                                    '<i class="icofont-google-map" style="font-size:16px;color:#000"></i>Hyderabad</h5>';
                                testDiv += '</a>';

                                testDiv +=
                                    '<div class="flex items-center justify-between mt-2">';
                                testDiv +=
                                    '<span class="text-3xl font-bold text-gray-900 dark:text-white">₹' +
                                    data.total_price + '/-</span>';
                                testDiv +=
                                    '<a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 btn_add_to_cart_test" value="' +
                                    data.test_ids + '" data-type="test" data-lab="' + data
                                    .lab_id + '"';
                                testDiv += 'data-price="' + data.total_price + '"';
                                testDiv += 'data-singleprice="' + data.single_price + '">';

                                testDiv += 'Add to cart</a>';
                                testDiv += '</div>';
                                testDiv += '</div></div>';
                            })

                            $.each(response.searchTerms.name, function(index, data) {
                                var id = response.searchTerms.id[index];
                                var count = 45;
                                var result = data.slice(0, count) + (data.length > count ?
                                    "..." : "");

                                searchDiv +=
                                    '<span id="badge-dismiss-green" class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-300">';
                                searchDiv += result +
                                    '<button type="button" class="close_search_btn inline-flex items-center p-1 ms-2 text-sm text-green-400 bg-transparent rounded-sm hover:bg-green-200 hover:text-green-900 dark:hover:bg-green-800 dark:hover:text-green-300" data-dismiss-target="#badge-dismiss-green" aria-label="Remove" data-id="' +
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
                            $('#searchHaederResult').html(testDiv);
                            $('#searchBreadcumb').removeClass('hidden');
                            $('#testChip').html(searchDiv);
                        }
                    }
                })
            }
        })
    $(document).on('click', '.btn_add_to_cart_test', function(){
        var button = $(this);
        $(button).html('<i class="icofont-spinner-alt-6" style="padding:2px"></i>');
        var productId = $(this).val();
        var dataType = $(this).attr("data-type");
        var labId = $(this).attr("data-lab");
        var price = $(this).attr("data-price");
        var singleprice = $(this).attr("data-singleprice");

        var formData = {
            productId: productId,
            dataType: dataType,
            labId: labId,
            price: price,
            singleprice: singleprice
        };
        console.log('productId', productId);
        $.ajax({
            type: 'POST',
            data: formData,
            url: APP_URL + '/test/add-to-cart',

            success: function (response, textStatus, xhr) {
                // console.log('productId', response.cart)
                if (xhr.status === 200) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmbutton: false,
                        timer: 3000
                    })
                    Toast.fire({
                        type: 'success',
                        title: 'Test Added Successfully',
                        //html: errorHtml,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //window.location.reload(); // Reload the page
                            $(button).html('Add to Cart');
                            $('.badge-danger').html(response.cart);
                            $('html, body').animate({
                                scrollTop: $('header').offset().top
                            }, 1000);
                        }
                    });
                } else {
                    alert(response.data)
                    //window.location.reload();
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    </script>
@endpush
