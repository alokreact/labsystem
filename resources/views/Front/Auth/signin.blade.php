@extends('Front.layout.mainlayout')
@section('content')
    <div class="flex justify-between">
        <div class="w-1/2 bg-blue-300">
            <div class="p-3 h-screen flex items-center justify-center flex-col">
                <img src="{{ asset('Image/bglogin.jpg') }}" alt="login" />
                <p class="text-basic text-white font-semibold mt-8">Everything you need just a customizable dashboard</p>
            </div>
        </div>


        <div class="w-1/2 flex">
            <div class="container mx-auto border">
                <div class="p-6 h-screen flex items-center justify-center flex-col">
                    <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        Sign in to your Acccount</h5>

                    <p class="text-xs text-black font-normal mt-2">Welcome back please enter your detail</p>

                    <div class="signinDiv w-full">

                        <div class="mb-4 w-full flex items-center justify-start flex-col mt-6">
                            <input type="text" placeholder="Phone No"
                                class="shadow appearance-none p-4 
                border rounded w-[50%]  text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name='mobile' id="mobile" />
                        </div>

                        <div class="mb-4 w-full flex items-center justify-start flex-col mt-6">
                            <button type="button"
                                class="inline-block rounded-3xl bg-blue-400 p-4 text-basic font-medium  leading-normal 
                                text-white shadow-lg transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] 
                                w-[50%] otp-btn"
                                data-te-ripple-init data-te-ripple-color="light">
                                Send OTP
                            </button>
                        </div>

                    </div>

                    @include('Front.Auth.otpverify')
                </div>
            </div>
        </div>
    </div>
@endsection
