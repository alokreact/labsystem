@extends('Front.layout.mainlayout')
@section('content')
    <div id="loader"
        class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-75 flex justify-center items-center z-50 hidden">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-12 w-12"></div>
    </div>

    <div class="flex justify-between">
        <div class="w-1/2 bg-green-200">
            <div class="p-3 h-screen flex items-center justify-center flex-col">
                <img src="{{ asset('Image/bglogin.jpg') }}" alt="login" />
                <p class="text-basic text-white font-semibold mt-8">Everything you need just a customizable dashboard</p>
            </div>
        </div>

        <div class="w-1/2 flex">
            <div class="container mx-auto border">
                <div class="p-6 h-screen flex items-center justify-center flex-col">
                    <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        Upload your Report</h5>

                    <p class="text-xs text-black font-normal mt-2">
                        please enter your detail</p>

                    <div class="mb-4 w-full flex items-center justify-start flex-col mt-6">
                        <input placeholder="Full Name"
                            class="shadow appearance-none p-4 
                    border rounded w-[50%]  text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            name="name" id="name" />

                        <span class="error_name" style="color:red"></span>
                        @if ($errors->has('name'))
                            <strong style="color:red"> {{ $errors->first('name') }}</strong>
                        @endif
                    </div>

                    <div class="mb-4 w-full flex items-center justify-start flex-col mt-6">

                        <input placeholder="Phone No"
                            class="shadow appearance-none p-4 
                border rounded w-[50%]  text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            name="phone" id="phone" maxlength="10" />

                        <span class="error_phone" style="color:red"></span>

                        @if ($errors->has('phone'))
                            <strong style="color:red"> {{ $errors->first('phone') }}</strong>
                        @endif

                    </div>

                    <div class="mb-4 w-full flex items-center justify-start flex-col mt-6">
                        <input type="file" name="report" id="report"
                            class="block w-[50%] text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                        
                            <span class="error_report" style="color:red"></span>

                        @if ($errors->has('report'))
                            <strong style="color:red"> {{ $errors->first('report') }}</strong>
                        @endif

                    </div>

                    <div class="mb-4 w-full flex items-center justify-start flex-col mt-6">

                        <button type="button"
                            class="inline-block rounded-3xl bg-blue-400 p-4 text-basic font-medium  leading-normal 
                                text-white shadow-lg transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] 
                                w-[50%] prescription-btn"
                            data-te-ripple-init data-te-ripple-color="light">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
