<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
@extends('needed-module-js')
<!--flutterwave setup starts here -->
<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>


<form>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    {{--<button type="button" onClick="payWithRave()">Pay Now</button>--}}
</form>

<script>

    function raveCurrencySwitch(country = '', currency = '', amount = '', converted_amount = '') {
        currency = currency.toUpperCase();
        var currencyArray = ['BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN',
            'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD', 'ZAR'];

        var countryCodeArray = ['BI', 'CA', 'DRC', 'CV', 'EU', 'GB', 'GH', 'GMD', 'GNF', 'KE', 'LRD', 'MWK', 'MZN',
            'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD', 'ZA'];

        var array_result = [];
        array_result['country'] = country;
        array_result['currency'] = currency;
        array_result['amount'] = amount;
        array_result['converted_amount'] = converted_amount;

        var checkCurrency = currencyArray.includes(currency);

        if (checkCurrency == true) {

            if (currency == "KES") {
                array_result["country"] = "KE";
                return array_result;

            } else if (currency == "GHS") {
                array_result["country"] = "GH";
                return array_result;
            } else if (currency == "ZAR") {
                array_result["country"] = "ZA";
                return array_result;
            } else if (currency == "ZAR") {
                array_result["country"] = "ZA";
                return array_result;
            } else {
                array_result["country"] = "NG";
                return array_result;
            }

        } else {
            array_result["country"] = "NG";
            array_result["currency"] = "NGN"
            array_result["converted_amount"] = amount;
            return array_result;
        }

    }

    const API_publicKey = '{{$data['payment_gateway_details']['gateway_manager']}}';


    function payWithRave() {

        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: '{{$data['email_address'] }}',
            custom_description: '{{$data['action_type']}}',
            amount: '{{$data['amount']}}',
            customer_phone: '{{$data['phone_number']}}',
            currency: '{{$data['currency_details']['second_currency']}}',
            txref: '{{$data['unique_id']}}',
            meta: [{
                metaname: "full_name",
                metavalue: '{{$data['full_name']}}'
            }],
            onclose: function() {
                window.location.href = "{{route('wallet', [auth()->user()->type_of_user === 'user' ? auth()->user()->unique_id : ''])}}"
            },
            callback: async function(response) {
                var txref = response.data.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
                if (
                    response.data.data.status == "completed" ||
                    response.data.data.status == "successful"
                ) {
console.log(response.data.data)
                    // verify and confirm payments
                    let check_payment = await postRequest('{{URL::to('/')}}/api/validate_flutter_wave_top_up_payment', {
                        flutter_wave:response.data.data,
                        unique_id:'{{$data['unique_id']}}'
                    });

                    if(check_payment.error_code == 0){

                        window.location.href = '{{$data['site_base_url'].'transaction_history/'.$data['unique_id']}}';


                    }else if(check_payment.error_code == 1){
                        window.location.href = '{{$data['site_base_url']}}failed_api';

                    }

                } else {
                    // redirect to a failure page.
                    window.location.href = '{{$data['site_base_url']}}failed_api';
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }

    $(document).ready(function () {
        payWithRave();
    })
</script>

