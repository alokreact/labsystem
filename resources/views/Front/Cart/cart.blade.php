@extends('Front.layout.mainlayout')
@section('content')

    @include('Front.Components.breadcrumb')

    <div class="container mx-auto">

        <div class="relative overflow-x-auto mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $id => $details)                                  
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @forelse($product_names as $name)
                            {{ $name }},

                        @empty
                        @endforelse
                        </th>


                        <td class="px-6 py-4">
                            {{ $details->name }}
                        </td>
                        <td class="px-6 py-4">
                            ₹{{ $details->price }}/-
                        </td>
                    </tr>

                    @endforeach
                 </tbody>
                <tfoot>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <th scope="row" class="px-6 py-3 text-base">Total</th>
                        <td class="px-6 py-3">3</td>
                        <td class="px-6 py-3">₹{{ $details->price }}/-</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
@endsection
