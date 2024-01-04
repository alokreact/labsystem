<html>
<head>
    <META http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600&family=Poppins&display=swap');

    body,
    table {
        font-family: 'Nunito', sans-serif;
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        font-size: 16px;
    }
</style>

<body>
    <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%"
        style="max-width:100%;background:#e9e9e9;padding:50px 0px">
        <tr>
            <td>
                <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width:600px;background:#ffffff;padding:0px 25px">
                    <tbody>
                        <tr>
                            <td style="margin:0;padding:0">
                                <table border="0" cellpadding="20" cellspacing="0" width="100%"
                                    style="background:#ffffff;color:#1a1a1a;line-height:150%;text-align:center;border-bottom:1px solid #e9e9e9;font-family:300 14px &#39;'Nunito', sans-serif;">
                                    <tbody>
                                        <tr>
                                            <td valign="top" align="center" width="100"
                                                style="background-color:#ffffff">
                                                <img alt="Swiggy" style="width:134px"
                                                    src="http://www.calllabs.in/images/Logo-removebg.png">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>

                                <table border="0" cellpadding="" cellspacing="0" width="100%"
                                    style="background:#ffffff;color:#000000;line-height:150%;text-align:center;font:300 16px;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                    <tbody>
                                        <tr>
                                            <td valign="top" width="100">
                                                <h3 style="text-align:center;text-transform:uppercase">CALL LABS Order
                                                    Summary</h3>
                                                <p>Payment method: <span style="font-size:18px;font-weight:bold">Cash On
                                                        Sample Collection</span></p>
                                                <p>Date: <span
                                                        style="font-size:18px;font-weight:bold">{{ $data['date']->format('d-m-Y') }}
                                                    </span></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>

                                <table border="0" cellpadding="20" cellspacing="0" width="100%"
                                    style="color:#000000;line-height:150%;text-align:left;font:300 16px ;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                    <tbody>
                                        <tr>
                                            <td valign="top" style="font-size:24px;">
                                                <span style="text-decoration:underline;">Order
                                                    No:#{{ $data['order_id'] }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <table align="center" cellspacing="0" cellpadding="6" width="95%"
                                    style="border:0;color:#000000;line-height:150%;text-align:left;font:300 14px/30px;font-family:Verdana, Geneva, Tahoma, sans-serif;"
                                    border=".5px">
                                    <thead>
                                        <tr style="background:#efefef">
                                            <th scope="col" width="30%"
                                                style="text-align:left;border:1px solid #eee">Test/Package Name</th>
                                            <th scope="col" width="15%"
                                                style="text-align:right;border:1px solid #eee">Lab Name</th>
                                            <th scope="col" width="20%"
                                                style="text-align:right;border:1px solid #eee">Price</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @forelse ($data['items']['name'] as $key => $item)
                                            <tr width="100%">
                                                <td width="30%"
                                                    style="text-align:left;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0;word-wrap:break-word;font-family:Verdana,Geneva,Tahoma, sans-serif;">

                                                    {{-- //@foreach ($data['product_names'] as $name) --}}
                                                        
                                                    {{ $data['product_names'][$key] }},

                                                   {{-- // @endforeach --}}

                                                </td>
                                                <td width="15%"
                                                    style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                                    {{ ucfirst($item) }}
                                                </td>
                                                <td width="20%"
                                                    style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                                    <span>

                                                        {{ $data['items']['price'][$key] }}/-
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>No Data</p>
                                        @endforelse
                                    </tbody>



                                    <tfoot>

                                        <tr>
                                            <th scope="row" colspan="2"
                                                style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                                Subtotal </th>
                                            <th
                                                style="text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                                <span>{{ $data['total'] }}/-</span>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th scope="row" colspan="2"
                                                style="text-align:right;background:#efefef;text-align:right;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:0;border-top:0;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                                Order Total</th>
                                            <td
                                                style="background:#efefef;text-align:right;vertical-align:middle;border-left:1px solid #eee;border-bottom:1px solid #eee;border-right:1px solid #eee;border-top:0;color:#7db701;font-weight:bold">
                                                <span>Rs.{{ $data['total'] }}/-</span>
                                            </td>
                                        </tr>

                                    </tfoot>
                                </table>

                                <br>
                                <br>

                                <table border="0" cellpadding="20" cellspacing="0" width="100%"
                                    style="color:#000000;line-height:150%;text-align:left;font:300 14px;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                    <tbody>
                                        <tr>
                                            <td valign="top">
                                                <h4 style="font-size:24px;margin:0;padding:0;margin-bottom:10px;">
                                                    Details</h4>

                                                <p style="margin:0;margin-bottom:10px;padding:0;"><strong>Name:</strong>
                                                    {{ $data['address']['name'] }}</p>
                                                <p style="margin:0;margin-bottom:10px;padding:0;">
                                                    <strong>Email:</strong> {{ $data['address']['email'] }}
                                                </p>
                                                <p style="margin:0;margin-bottom:10px;padding:0;"><strong>Tel:</strong>
                                                    {{ $data['phone'] }}</p>
                                                <p style="margin:0;margin-bottom:10px;padding:0;">
                                                    <strong>Address:</strong> {{ $data['address']['address1'] }}
                                                </p>
                                                <p style="margin:0;margin-bottom:10px;padding:0;">
                                                    {{ $data['address']['city'] }}, {{ $data['address']['zip'] }} </p>

                                                <p style="margin:0;margin-bottom:10px;padding:0;"><strong>Sample Pickup
                                                        date:</strong> {{ $data['slot_day'] }}</p>
                                                <p style="margin:0;margin-bottom:10px;padding:0;"><strong>Sample Pickup
                                                        time:</strong> {{ $data['slot_time'] }}</p>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <table border="0" cellpadding="20" cellspacing="0" width="100%"
                                    style="color:#000000;line-height:150%;text-align:left;font:300 14px;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                    <tbody>
                                        <tr>
                                            <td valign="top">
                                                <h4 style="font-size:24px;margin:0;padding:0;margin-bottom:10px;">
                                                    Patient Details</h4>

                                                    @if(count($data['patients'])>0)
                                                
                                                    @foreach ($data['patients'] as $patient)
                                                        <p style="margin:0;margin-bottom:10px;padding:0;">
                                                            <strong>Name:</strong> {{ $patient->name }}
                                                        </p>
                                                        <p style="margin:0;margin-bottom:10px;padding:0;">
                                                            <strong>Age:</strong> {{ $patient->age }}
                                                        </p>
                                                @endforeach

                                                @else

                                                    <p style="margin:0;margin-bottom:10px;padding:0;">
                                                        <strong>Name:</strong> {{ $data['patients']->name }}
                                                    </p>
                                                    <p style="margin:0;margin-bottom:10px;padding:0;">
                                                        <strong>Age:</strong> {{ $data['patients']->age }}
                                                    </p>

                                                @endif
                                            
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <table border="0" cellpadding="20" cellspacing="0" width="100%"
                                    style="color:#000000;line-height:150%;text-align:left; font:300 14px;font-family:Verdana, Geneva, Tahoma, sans-serif">
                                    <tbody>
                                        <tr>
                                            <td valign="top">
                                                <h4
                                                    style="font-family:Verdana, Geneva, Tahoma, sans-serif;font-size:24px;margin:0;padding:0;margin-bottom:10px;">
                                                    Address</h4>

                                                <p style="font-family:Verdana, Geneva, Tahoma, sans-serif">
                                                    CALL LABS
                                                    <br />Vasavi Colony
                                                    <br /> Kothapet, Hyderabad
                                                    <br /> 500084
                                                    <br /> GSTIN: 27AALFN0535C1ZK
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <br>

                                <table cellspacing="0" cellpadding="6" width="100%"
                                    style="color:#000000;line-height:150%;text-align:left;font:300 16px; font-family:Verdana, Geneva, Tahoma, sans-serif;"
                                    border="0">
                                    <tbody>
                                        <tr>

                                            <td valign="top" style="text-transform:capitalize">
                                                <p
                                                    style="font-size:14px;line-height:30px;font-family:Verdana, Geneva, Tahoma, sans-serif;">
                                                    We declare that this invoice shows the actual price of the goods
                                                    described above and that all particulars are true and correct. The
                                                    goods sold are intended for end user consumption and not for resale.
                                                    Please call <b>7893620870</b> in case of any doubts or questions.
                                                </p>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <br>

                                <br>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center"
                                    style="border-top:1px solid #e9e9e9;border-bottom:1px solid #e9e9e9;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0px">
                                    <tbody>
                                        <tr>
                                            <td align="left" width="33%">
                                                <table border="0" cellspacing="0" cellpadding="0"
                                                    style="font-family:'Nunito', sans-serif;font-size:12px">
                                                    <tbody>
                                                        <tr>
                                                            <td width="60%">Download the App: </td>
                                                            <td width="5%"> </td>
                                                            <td width="15%">
                                                                <a href="#" target="_blank">
                                                                    <img style="max-height:20px;width:auto"
                                                                        src="https://res.cloudinary.com/swiggy/image/upload/v1447855172/Android_qt1acy.png"></a>
                                                            </td>
                                                            <td width="5%"> </td>
                                                            <td width="15%">
                                                                <a href="#" target="_blank">
                                                                    <img style="max-height:20px;width:auto"
                                                                        src="https://res.cloudinary.com/swiggy/image/upload/v1447855170/Apple_e7lnfc.png"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td align="center" width="47%">
                                                <table border="0" cellspacing="0" cellpadding="0" height="50"
                                                    style="font-family: 'Nunito', sans-serif;font-size:12px;color:#9b9b9b">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                © 2023-CALL LABS. All rights reserved.
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td align="right" width="20%">
                                                <table border="0" cellspacing="0" cellpadding="0" height="50"
                                                    style="font-family:'Nunito', sans-serif;font-size:12px">
                                                    <tbody>
                                                        <tr>
                                                            <td width="5%"></td>
                                                            <td width="20%">
                                                                <a href="https://www.facebook.com/swiggy.in"
                                                                    target="_blank">
                                                                    <img style="max-height:20px;width:auto"
                                                                        src="https://res.cloudinary.com/swiggy/image/upload/v1447855170/Facebook_ezoqwy.png"
                                                                        alt="Swiggy Facebook" style="display:block"
                                                                        border="0"></a>
                                                            </td>
                                                            <td width="5%"> </td>
                                                            <td width="20%">
                                                                <a href="https://twitter.com/swiggy_in"
                                                                    target="_blank">
                                                                    <img style="max-height:20px;width:auto"
                                                                        src="https://res.cloudinary.com/swiggy/image/upload/v1447855171/Twitter_stmvbr.png"
                                                                        alt="Swiggy Twitter" style="display:block"
                                                                        border="0"></a>
                                                            </td>
                                                            <td width="5%"> </td>
                                                            <td width="20%">
                                                                <a href="https://www.pinterest.com/swiggyindia/"
                                                                    target="_blank">
                                                                    <img style="max-height:20px;width:auto"
                                                                        src="https://res.cloudinary.com/swiggy/image/upload/v1447855171/Pinterest_dd2nv9.png"
                                                                        alt="Swiggy pinterest" style="display:block"
                                                                        border="0"></a>
                                                            </td>
                                                            <td width="5%"> </td>
                                                            <td width="20%">
                                                                <a href="https://instagram.com/swiggyindia/"
                                                                    target="_blank">
                                                                    <img style="max-height:20px;width:auto"
                                                                        src="https://res.cloudinary.com/swiggy/image/upload/v1447855170/Instagram_okx3pg.png"
                                                                        alt="Swiggy instagram" style="display:block"
                                                                        border="0"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center"
                                    style="font-family: 'Nunito', sans-serif;font-size:12px;padding:0px;font-size:12px;color:#9b9b9b;">
                                    <tbody>
                                        <tr>
                                            <td align="center" width="33.3333%">
                                                Vasavi Colony, Kothapet, Hyderabad - 500084.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
