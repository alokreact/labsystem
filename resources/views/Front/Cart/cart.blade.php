@extends('Front.layout.mainlayout')
@section('content')

    @include('Front.Components.breadcrumb')
    <div class="container mx-auto">
        <div class="relative overflow-x-auto mt-4 h-screen">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lab Name
                        </th>
                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($carts as $id => $details)
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap 
                                dark:text-white w-[30%]">
                                @forelse($product_names as $name)
                                    {{ $name }},
                                @empty
                                @endforelse
                            </th>

                            <td class="px-6 py-4">{{ $details->name }}</td>
                            <td class="px-6 py-4">₹{{ $details->price }}/-</td>

                            <td class="actions px-6 py-3 rounded-e-lg">
                                <button class="btn btn-danger btn-sm cart_remove" value="{{ $details->id }}"><i
                                        class="icofont-ui-delete"></i></button>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>

                <tfoot>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        @forelse ($carts as $id => $details)
                            <td class="px-6 py-3"></td>
                            <td class="px-6 py-3"></td>
                            <th scope="row" class="px-6 py-3 text-base">Total</th>
                           
                            <td class="px-6 py-3">₹{{ $details->price }}/-</td>

                        @empty
                        @endforelse
                    </tr>
                </tfoot>
            </table>


            <div class="relative flex justify-end mt-10 p-4">

                <button type="button"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Continue To Shop</button>

                <a href="{{ route('checkout') }}">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Checkout</button>
                </a>
            </div>





        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(".cart_remove").click(function(e) {
            e.preventDefault();
            var ele = $(this).val();
            Swal.fire({
                title: 'Success!',
                text: 'Do you really want to remove?',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('remove_product_from_cart') }}",
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele
                        },
                        success: function(response, textStatus, xhr) {

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
                                    title: response.message,

                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                })
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
