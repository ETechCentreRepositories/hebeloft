<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <style>
            body {
                font-size: 12px;
            }

            .container {
                max-width: 1300px;
            }

            .noTopBorder {
                border-top:none !important;
            }

            .wrapContentTd {
                white-space: nowrap;
                width: 1%;
            }

            .addressTd {
                font-size: 11px;
            }

            .rightAlign {
                text-align: right;
            }

            .blackBorder {
                border: 1px solid black !important;
            }
            
            .addPadding {
                padding: 5;
            }

            .coloredHeader {
                background: lightgrey;
            }

            .noTopPadding {
                padding-top: 0 !important;
            }

            .noBottomBorder {
                border-bottom: none !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <table class="table headerTable">
                <tbody>
                    <tr>
                        <td class="wrapContentTd noTopBorder">
                            <img src="http://www.ehostingcentre.com/hebeloft/storage/logo/hebeloft_logo.png" style="width: 150px;">
                        </td>
                        <td class="addressTd noTopBorder">
                            <b>Hebeloft Pte Ltd</b><br>
                            71 Ubi Road 1, #06-38, Oxley Bizhub<br>
                            Singapore, Singapore Singapore 408732<br>
                            www.hebeloft.com<br>
                            Email enquiry@hebeloft.com<br>
                            Tel 65 67026972<br>
                            Fax 65 67026971<br>
                            GST Registration No. : 201229209C
                        </td>
                        <td class="noTopBorder">
                            <div class="rightAlign">
                                <b style="font-size: 18px;">Delivery Order</b>
                            </div>
                            <div class="blackBorder addPadding">
                                Invoice #SO-{{$datas[0]['date']}}-{{$datas[0]['sales_order_id']}}<br>
                                Date {{$datas[0]['date']}}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table headerTable">
                <tbody>
                    <tr>
                        <td class="wrapContentTd noTopBorder">
                            Billing Address
                        </td>
                        <td class="noTopBorder">
                            <b>{{$datas[0]['company_name']}}</b><br>
                            {{$datas[0]['billing_address']}}
                            <!-- <b>SINCHONG MEHECO LTD</b><br>
                            10<br>
                            JALAN KILANG TIMOR<br>
                            #02-01, LTH BUILDING<br>
                            Singapore<br>
                            159306<br> -->
                        </td>
                        <td class="wrapContentTd noTopBorder">
                            Shipping Address
                        </td>
                        <td class="noTopBorder">
                            <b>{{$datas[0]['company_name']}}</b><br>
                            {{$datas[0]['shipping_address']}}
                            <!-- <b>SINCHONG MEHECO LTD</b><br>
                            10<br>
                            JALAN KILANG TIMOR<br>
                            #02-01, LTH BUILDING<br>
                            Singapore<br>
                            159306<br> -->
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table headerTable">
                <tbody>
                    <tr>
                        <td class="wrapContentTd noTopBorder">
                            Contact<br>
                            Phone
                        </td>
                        <td class="noTopBorder">
                            {{$datas[0]['name']}}<br>
                            {{$datas[0]['phone_number']}}
                        </td>
                        <td class="wrapContentTd noTopBorder">
                        </td>
                        <td class="addressTd noTopBorder">
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <thead>
                    <tr>
                        <th class="blackBorder coloredHeader">Item</th>
                        <th class="blackBorder coloredHeader rightAlign">Quantity</th>
                        <th class="blackBorder coloredHeader rightAlign">Unit Price (SGD)</th>
                        <th class="blackBorder coloredHeader rightAlign">Sub-total (SGD)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td class="blackBorder">{{$data['Name']}}</td>
                        <td class="blackBorder rightAlign">{{$data['quantity']}}</td>
                        <td class="blackBorder rightAlign">{{$data['UnitPrice']}}</td>
                        <td class="blackBorder rightAlign">{{$data['subtotal']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="table headerTable">
                <tbody>
                    <tr>
                        <td class="wrapContentTd noTopBorder">
                            Remarks
                        </td>
                        <td class="blackBorder">
                        {{$datas[0]['remarks']}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>