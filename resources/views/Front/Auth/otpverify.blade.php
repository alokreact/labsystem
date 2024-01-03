<div class="otpDiv w-full hidden">

    <div class="mb-4 w-full flex items-center justify-center flex-row mt-6">
        @for ($i = 1; $i <= 4; $i++)

        <input type="text" name="otp[]"
            class="otp-input w-16 h-10 text-3xl mx-1 text-center border rounded" maxlength="1"
            autocomplete="off" data-next="{{ $i + 1 }}" required 
            oninput="shiftFocus(this, {{ $i + 1 }})"/>
        @endfor
    </div>


    <div class="mb-4 w-full flex items-center justify-start flex-col mt-6">
        <button type="button"
            class="inline-block rounded-3xl bg-blue-400 p-4 text-basic font-medium  leading-normal 
                    text-white shadow-lg transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] 
                    w-[50%]"
            data-te-ripple-init data-te-ripple-color="light" id="btn-verify-otp">
            Sign In
        </button>

    </div>
</div>

@push('after-scripts')

    <script>
      
        function  shiftFocus(currentInput, nextInputIndex) {
            const maxLength = parseInt(currentInput.getAttribute('maxlength'));
            const currentLength = currentInput.value.length;
            if (currentLength === maxLength) {
                const nextInput = document.querySelector(`.otp-input[data-next="${nextInputIndex++}"]`);
                if (nextInput) {
                    console.log('>>>')
                    nextInput.focus();
                    nextInput.select();
                }
            }
        }
    </script>
@endpush
