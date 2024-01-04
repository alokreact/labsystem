<!-- resources/views/emails/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Website</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>


<body class="font-sans">
    <div class="bg-gray-600 p-6">
        <h1 class="text-2xl font-bold mb-4">Welcome to Our Website!</h1>
        <p class="text-gray-700">Thank you for joining us. We're excited to have you on board.</p>
        <p class="text-gray-700">Best regards,<br> Your Company Name</p>
   
    </div>


    <div class="conatiner bg-gray-600">

        <div class="p-6 flex flex-col border-b-2 mb-4">
            <h1 class="text-2xl font-bold mb-2">Your Order is confirmed</h1>
            <h1 class="text-2xl font-bold mb-4">Hi John!</h1>
                    <span class="text-xs font-bold mt-2">Your Order has been confirmed!</span>
        </div>


        <div class="p-6">

            <h1 class="text-2xl font-bold mb-2">Order #12325</h1>
         
            <div class="flex justify-between mt-2">

                <div class="flex flex-col p-3  border">
                    <h3 class="text-xl font-bold mb-2">Patient</h3>
                    <h3>Name:</h3>
                    <h3>Age:</h3> 
                    
                    <h3>Gender:</h3> 
                   
                </div>

                <div class="flex flex-col p-3  border">
                    <h3 class="text-xl font-bold mb-2">Billing Address</h3>
                    <h3>Name:</h3>
                    <h3>Age:</h3>     
                    <h3>Gender:</h3> 
                   
                </div>
                <div class="flex flex-col p-3  border">
                    <h3 class="text-xl font-bold mb-2">Billing Address</h3>
                    <h3>Name:</h3>
                    <h3>Age:</h3>     
                    <h3>Gender:</h3> 
                </div>

            </div> 
            
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr>
                            <td class="py-2 px-4 border-b">Order ID</td>
                            <td class="py-2 px-4 border-b">Product</td>
                            <td class="py-2 px-4 border-b">Quantity</td>
                            <td class="py-2 px-4 border-b">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b">12345</td>
                            <td class="py-2 px-4 border-b">product_name</td>
                            <td class="py-2 px-4 border-b">2</td>
                            <td class="py-2 px-4 border-b">$456/-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>


        
        

    </div>
</body>
</html>