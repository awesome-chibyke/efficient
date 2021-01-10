<input type="hidden" value="{{URL::to('/')}}" id="base_url">
<style>
    .hidden{
        display: none;
    }
    .bootstrap-tagsinput input{
        color: black !important;
    }
</style>
<script src="{{asset('/js/backEnd/jquery.min.js')}}"></script>
<script src="{{asset('/js/backEnd/popper.min.js')}}"></script>
<script src="{{asset('js/backEnd/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/backEnd/bundle.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/setting.js')}}"></script>
<script src="{{asset('js/backEnd/default-assets/fullscreen.js')}}"></script>

<!-- Active JS -->
<script src="{{asset('/js/backEnd/default-assets/active.js')}}"></script>

<!-- These plugins only need for the run this page -->
<script src="{{asset('/js/backEnd/default-assets/apexchart.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/dashboard-active.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/am-chart.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/gauge.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/serial.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/light.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/ammap.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/worldlow.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/worldlow.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/widget-page-chart-active.js')}}"></script>
<script src="{{asset('/js/backEnd/jquery.steps.min.js')}}"></script>
<script src="{{asset('/js/backEnd/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/wizard-form.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/jquery.datatables.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/datatables.bootstrap4.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/datatable-responsive.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/datatable-button.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/button.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/button.html5.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/button.flash.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/button.print.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/datatables.keytable.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/datatables.select.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/demo.datatable-init.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/modal-classes.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/modaleffects.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/summernote.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/summernote-active.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/sweetalert2.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/sweetalert-init.js')}}"></script>
<script src="{{asset('/js/backEnd/toast/jquery.toast.js')}}"></script>
<script src="{{asset('/js/backEnd/toast/toast-functions.js')}}"></script>
<script src="{{asset('main/errors/error_helper.js')}}"></script>
<script src="{{asset('/js/coppier/clipboard.min.js')}}"></script>

<script src="{{asset('js/banks.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>


<!-- These plugins only need for the run this page -->
<script src="{{asset('/js/backEnd/default-assets/ekko-lightbox.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/lightbox.min.js')}}"></script>
<script src="{{asset('/js/backEnd/default-assets/light-box-active.js')}}"></script>

<!--tags input-->
<script src="{{asset('/js/backEnd/tag_input/bootstrap-tagsinput.min.js')}}"></script>

<script src="{{asset('/plugings/dateTime/jquery.datetimepicker.full.js')}}"></script>

@include('select_2')

@php $settings = new \App\Models\AppSettings() @endphp
@php $settings = $settings->getSingleModel() @endphp
@include('needed-module-js')
@include('date-master-picker')
<?php $baseUrl = URL::to('/')  ?>
<script>
    let baseUrl = $("#base_url").val().trim();
    //manage user accounts

    $(document).ready(function () {
        if($(".smallCheckBox")){
            $(".smallCheckBox").prop('checked', false);
        }
    });

    async function accountManager(a, action) {

        let retVal = confirm('Please click the `OK` to continue');
        if(retVal === true){

            let userID = $(a).attr('data-user-holder');

            let manageAccount = await postRequest('{{route('manage_account')}}', {action:action, userId:userID});

            if(manageAccount.error_code ==  0){
                returnFunctions.showSuccessToaster(manageAccount.success_message, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                returnFunctions.showSuccessToaster(manageAccount.error_message, 'warning');
            }

        }

    }


    function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

            const negativeSign = amount < 0 ? "-" : "";

            let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
            console.log(e)
        }
    }

    function bringOutModalMain(value) {
        //$(value).removeClass('hidden');
        $(value).modal('show');
    }

    $(document).ready(function () {
        //
        let a=$("#datatable-buttons").DataTable(
            {lengthChange:!1,
                buttons:["copy","print"],
                language:{
                    paginate:{
                        previous:"<i class='arrow_carrot-left'>",
                        next:"<i class='arrow_carrot-right'>"
                    }},
                drawCallback:function(){
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }});

        let c=$("#datatable-buttons_2").DataTable(
            {lengthChange:!1,
                buttons:["copy","print"],
                language:{
                    paginate:{
                        previous:"<i class='arrow_carrot-left'>",
                        next:"<i class='arrow_carrot-right'>"
                    }},
                drawCallback:function(){
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }});

        $("#selection-datatable").DataTable(
            {select:{style:"multi"},
                language:{
                    paginate:{
                        previous:"<i class='arrow_carrot-left'>",
                        next:"<i class='arrow_carrot-right'>"}},
                drawCallback:function(){
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")}}),
            a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
            //c.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")

        setTimeCountDown();

        @php $pageCountryArray = ['edit_centers','editProfile', 'create_center_page', 'edit_center_page'];  @endphp
        @if(@in_array( request()->segment(1), $pageCountryArray))

            let selCountry = $("#countryHolder").val();
            var count = getCountries(selCountry);
            $('#country').html(count);

        @endif
    });

    function setTimeCountDown() {
        // Set the date we're counting down to
        var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            var dateHolder;
            // Display the result in the element with id="demo"
            dateHolder = `<div class="col-lg-3 countDown">
                            <p class="countDown_p"><span>${days}</span> <br>Days</p>
                        </div>
                        <div class="col-lg-3 countDown">
                            <p class="countDown_p"><span>${hours}</span> <br>Hours</p>
                        </div>
                        <div class="col-lg-3 countDown">
                            <p class="countDown_p"><span>${minutes}</span> <br>Minute</p>
                        </div>
                        <div class="col-lg-3 countDown">
                            <p class="countDown_p"><span>${seconds}</span> <br>Seconds</p>
                        </div>` ;

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                dateHolder = `<div class="col-lg-12 countDown">
                                   <p class="countDown_p"><span>GAME EXPIRED</span></p>
                               </div>`;
            }
            $('.setTimeCountDown').html(dateHolder);
        }, 1000);
    }

    function togglePassword(val, val2) {
        let x = document.getElementById(val);
        $(val2).toggleClass("fa-eye fa-eye-slash");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    async function triggerTopup(a) {//flutter_wave_top_up bank_top_up

        let retVal = confirm('Please Click `OK` to continue');
        if(retVal === true){
            $(a).text('Loading.....').attr({'disabled':true});
            let Amount = $("#account_topUp").val();
            let option_for_payment = $("#option_for_payment").val();

            if(option_for_payment === ''){
                returnFunctions.showSuccessToaster('Payment Option/Method is required', 'warning');
                $(a).text('Add Fund').attr({'disabled':false});
                return;
            }

            if(Amount === ''){
                returnFunctions.showSuccessToaster('Amount is required', 'warning');
                $(a).text('Add Fund').attr({'disabled':false});
                return;
            }

            if(isNaN(Amount)){
                returnFunctions.showSuccessToaster('Amount must be numeric', 'warning');
                $(a).text('Add Fund').attr({'disabled':false});
                return;
            }

            let amount = parseFloat(Amount).toString();
            let encodedAmount = btoa(amount);
            window.location.href = baseUrl+'/store_new_transaction/'+encodedAmount+'/top_up/'+option_for_payment;

        }

    }

    function getCountries(selectedCountry = ''){
        let optionHold = '';
        const country = ['Afghanistan','Albania','Algeria','Andorra','Angola','Antigua and Barbuda','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei Darussalam','Bulgaria','Burkina Faso','Burundi','Cabo Verde','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica','C?te dIvoire','Croatia','Cuba','Cyprus','Czech Republic','Democratic Peoples Republic of Korea North Korea','Democratic Republic of the Cong','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','Kuwait','Kyrgyzstan','Lao Peoples Democratic Republic Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico','Micronesia Federated States','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','Norway','Oman','Pakistan','Palau','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Republic of Korea South Korea','Republic of Moldova','Romania','Russian Federation','Rwanda','Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Swaziland','Sweden','Switzerland','Syrian Arab Republic','Tajikistan','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom of Great Britain and Northern Ireland','United Republic of Tanzania','United States of America','Uruguay','Uzbekistan','Vanuatu','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'];

        optionHold += `<option value="">Select Country</option>`;
        for(let i in country){
            let theSelectedCountry = selectedCountry == country[i] ? 'selected':'';
            optionHold += `<option ${theSelectedCountry}  value="${country[i]}">${country[i]}</option>`;
        }

        return optionHold;
        //$('#nationality').html(optionHold);
    }

    {{--@include('js_files.user_account_manager')--}}

    function checkAll() {
        if($(".mainCheckBox").is(':checked')){
            $(".smallCheckBox").prop('checked', true);
        }else{
            $(".smallCheckBox").prop('checked', false);
        }
    }

    function openNewsPage(pageName, unique_id = ''){

        window.open(pageName+'/'+unique_id, '_blank');

    }

    async function deleteSupport(a){
        let retVal = confirm('Do you really want to delete selected messages');
        if(retVal === true){
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){
                    dataArray.push($(selected[i]).val());
                }
            }

            $(a).text('Loading...').attr({'disabled':true});

            if(dataArray.length == 0){
                returnFunctions.showSuccessToaster('Please select at least one message to continue', 'warning');
                $(a).html("<i class='bx bx-trash'></i>").attr({'disabled':false});
                return;
            }

            let postData = await postRequest("{{route('handle_message_delete')}}", {dataArray:dataArray});

            if(postData.error_code == 0){
                $(a).html("<i class='bx bx-trash'></i>").attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000);
                return;

            }
            handleTheErrorStatement(postData.error_message, 'off', 'no', 'yes');
        }
    }

    async function makeTransferPayments(a) {

        let retVal = confirm('Do you really want to proceed with payments');
        if(retVal === true){
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){
                    dataArray.push($(selected[i]).val());
                }
            }

            $(a).text('Loading...').attr({'disabled':true});

            if(dataArray.length == 0){
                returnFunctions.showSuccessToaster('Please select at least one withdrawal to continue', 'warning');
                $(a).text('Make Payment').attr({'disabled':false});
                return;
            }

            let postData = await postRequest("{{route('handle_transfers')}}", {withdrawalId:dataArray.join('|')});

            if(postData.error_code == 0){
                $(a).text('Make Payment').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_message, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000);
                return;

            }
            handleTheErrorStatement(postData.error_message, 'off', 'no', 'yes');
        }

    }

    async function markAsPayed(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading.....').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Confirm Withdrawals').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one withdrawal to continue', 'warning');
                return;
            }

            let postData = await postRequest("{{route('confirm_withdrawal_payment')}}", {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Confirm Withdrawals').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Confirm Withdrawals').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'success');
            }
        }

    }

    function displayButttons(a) {
        $(a).removeClass('hidden');
    }

    function viewImage(imageLink) {
        window.open(imageLink, '_blank');
    }

    async function confirmTopUp(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Confirm Top Ups').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one withdrawal to continue', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/confirmTop', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Confirm Top Ups').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Confirm Top Ups').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'warning');
            }
        }
    }

    async function confirmDeleteNews(a) {
        let retVal = confirm('Do you wish to Delete the selected New(s)?');
        if(retVal === true){
            $(a).text('Loading').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete News').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one news to continue', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/confirmNewsDelete', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete News').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete News').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'warning');
            }
        }
    }

    function handleTheErrorStatement(error_statement, showField = 'off', useClassForFieldFocus = 'no', useModal = 'no') {

        $(".error_carrier").text('');

        var counter = 0; let theKey = '';
        let errorStatementLenght = Object.keys(error_statement).length;
        for(var i in error_statement){
            if(counter == 0){ theKey = i; }

            if(typeof error_statement[i] === 'string'){
                if(error_statement[i].indexOf(':') != -1){
                    error_statement[i] = error_statement[i].split(':');
                }
            }

            var txt = ''; let incomingErrorArray = [];
            for(var j in error_statement[i]){

                incomingErrorArray.push(error_statement[i][j]);

                txt += "<p style='font-size:12px' class='f-size error_carrier t-color'><span >*</span> "+error_statement[i][j]+"</p>";
            }

            if(i === 'general_error'){
                if(useModal === 'yes'){
                    callErrorModal(txt);
                    $(".errorAreaHolder p").removeClass('t-color');
                }else{
                    returnFunctions.showSuccessToaster(txt, 'warning');
                    $(".error_carrier").removeClass('t-color');
                }

            }else{
                $('.err_'+i).html(txt).removeClass('hidden');

                if(parseFloat(counter) == parseFloat(errorStatementLenght - 1)){
                    if(showField === 'on'){
                        scrollIntoDomView(theKey, useClassForFieldFocus);
                        //returnFunctions.showSuccessToaster('Some validation errors occurred.', 'warning');
                    }

                }
                counter++;
            }

        }

    }

    /*function scrollIntoDomView(selectedElement, useClassForFieldFocus){
        let prefix = '';
        let offset = '';
        if(useClassForFieldFocus === 'no'){
            offset = $("#"+selectedElement).offset(); // Contains .top and .left
            prefix = '#';
        }else{
            offset = $("."+selectedElement).offset(); // Contains .top and .left
            prefix = '.';
        }

        //Subtract 20 from top and left:

        offset.left -= 200;
        offset.top -= 200;
        //Now animate the scroll-top and scroll-left CSS properties of <body> and <html>:

        $('html, body').animate({
            scrollTop: offset.top,
            scrollLeft: offset.left
        });
        $(prefix+selectedElement).focus();

    }*/

    async function deletePlans(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading....').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Plan(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one withdrawal to continue', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/deletePlans', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Plan(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Plan(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'warning');
            }
        }
    }

    async function confirmDeleteOfGalleryImages(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading....').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Selected Images').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one image', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/deleteGalleryImage', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Selected Images').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Selected Images').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'warning');
            }
        }
    }

    async function confirmGalleryDelete(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading....').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Selected Galleries').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one Gallery', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/deleteGallery', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Selected Galleries').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Selected Galleries').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'warning');
            }
        }
    }

    async function confirmDeleteCenter(a) {
        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading....').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Selected Centers').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one Gallery', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/deleteCenter', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Selected Centers').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Selected Centers').attr({'disabled':false});
                handleTheErrorStatement(postData.error_message);
            }
        }
    }

    //delete selected transactions
    async function deleteSelectedTopUp(a) {

        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading...').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Transaction(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one Transaction detail to continue', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/deleteTransactionDetails', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Transaction(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Transaction(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'success');
            }
        }

    }

    async function deleteBankDetails(a) {

        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading...').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Bank details').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one Bank detail to continue', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/deleteBankDetails', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Bank details').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Bank details').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'success');
            }
        }

    }

    async function confirmDispensation(a) {

        let retVal = confirm('PLease make sure rewards for Investments have been fully dispensed to the selected user(s)?');
        if(retVal === true){
            $(a).text('Loading...').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Confirm Dispensation of Reward').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one investment', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/confirm_dispensation', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Confirm Dispensation of Reward').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Confirm Dispensation of Reward').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'success');
            }
        }

    }

    async function confirmDeleteFaqs(a) {

        let retVal = confirm('Do you really want to continue?');
        if(retVal === true){
            $(a).text('Loading...').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Selected Faq(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one Investment', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/confirm_faq_delete', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Selected Faq(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Selected Faq(s)').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'success');
            }
        }

    }

    async function confirmDeleteTestimonies(a) {

        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading...').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Delete Selected Testimonies').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one Testimony', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/confirm_testimony_delete', {dataArray:dataArray});
            if(postData.error_code == 0){
                $(a).text('Delete Selected Testimonies').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Delete Selected Testimonies').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.error_message, 'success');
            }
        }

    }

    async function approveTestimonies(a) {

        let retVal = confirm('Do you wish to continue?');
        if(retVal === true){
            $(a).text('Loading...').attr({'disabled':true});
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){

                    dataArray.push($(selected[i]).val());
                }
            }

            if(dataArray.length == 0){
                $(a).text('Approve Selected Testimonies').attr({'disabled':false});
                returnFunctions.showSuccessToaster('Please select at least one Testimony', 'warning');
                return;
            }

            let postData = await postRequest(baseUrl+'/approve_testimonies', {dataArray:dataArray});
            if(postData.error_code == 0){//approveTestimonies confirmDeleteTestimonies
                $(a).text('Approve Selected Testimonies').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Approve Selected Testimonies').attr({'disabled':false});
                handleTheErrorStatement(postData.error_statement);
            }
        }

    }

    function buildEmbededLink(selected_url){

        let exploded_url = selected_url.split("=");

        let url = 'https://www.youtube.com/embed/'+exploded_url[1];

        return url;
    }

    function playTestimony(video_link){

        let videoFrame = `<iframe id="mainVideoHolder" width="100%" height="420" src="${buildEmbededLink(video_link)}" frameborder="0" allow="autoplay; encrypted-media"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>`;

        $("#videoHolder").html(videoFrame);
        $(".playVideo").modal({ backdrop: 'static', keyboard: false });

    }

    function closeVideo(){
        $("#videoHolder").html('');
    }


    async function createTestimony(a) {

        let retVal = confirm('Click OK to continue?');
        if(retVal === true){
            //$(a).text('Loading...').attr({'disabled':true});

            let video_link = $("#video_link").val().trim();
            let testimony = $("#testimony").val().trim();
            let full_name = $("#full_name").val().trim();

            let postData = await postRequest(baseUrl+'/store_testimony', {video_link:video_link, testimony:testimony, full_name:full_name});
            if(postData.error_code == 0){
                $(a).text('Submit').attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    $("#video_link").val('');
                    $("#testimony").val('');
                    $("#full_name").val('');
                    location.reload();
                }, 5000)
            }else{
                $(a).text('Submit').attr({'disabled':false});
                handleTheErrorStatement(postData.error_statement);
            }
        }

    }



    function insertTransID(transID) {
        if(transID === ''){
            location.reload();
        }
        $("#transactionIdHolder").val(transID);
    }

    $(document).ready(function () {
        showMaxInvestAmount($("#max_investment_amount_switch"));

        showInvestDetails($("#investment_settings_unique_id"));//call the function that selects investment based on invesment settings

    })

    function showMaxInvestAmount(a){
        let selected = $(a).val();
        if(selected === 'on'){
            $(".max_investment_amount_holder").removeClass('hidden');
        }else{
            $(".max_investment_amount_holder").addClass('hidden');
        }
    }

    function shuffleAmountField(a) {

        let selected = $(a).val();
        if(selected === 'kind'){
            $(a).closest('.reward_type_case').siblings(".amount_holder").addClass('hidden');
        }else if(selected === 'cash'){
            $(a).closest('.reward_type_case').siblings(".amount_holder").removeClass('hidden');
        }

    }

    function addNewRewardField() {

        let reward_holders = $('.reward_holder');
        let TotalLength = reward_holders.length;
        let newCount = 0;
        for(let i = 0; i < TotalLength; i++){
            let lastValue = parseFloat(TotalLength)-parseFloat(1);
            if(parseFloat(i) == lastValue){
                let lastCount = $(reward_holders[i]).attr('reward_holder_count');
                newCount = parseFloat(lastCount) + 1;
            }
        }

        let field = `
        <div class="col-sm-12 reward_holder" reward_holder_count="${newCount}">
            <div class="row">

            <div class="col-lg-12 col-md-12">
                <strong>${newCount})</strong>
            </div>

            <div class="col-sm-12 reward_type_case">
                <div class="form-group">
                <input type="hidden" name="reward_unique_id[]" class="form-control" value=""  />
                    <label for="reward_type">{{ __('Nature of Reward') }}</label>
                    <select onchange="shuffleAmountField(this)" name="reward_type[]" class="form-control reward_type @error('reward_type') is-invalid @enderror">
                        <option value="">Select Nature of Reward</option>
                        <option value="cash">Reward for Investment Is In Cash</option>
                        <option selected value="kind">Reward for Investment Is In Kind</option>
                    </select>
                    @error('reward_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="reward">{{ __('Description of Reward') }}</label>
                                                        <input type="text" id="reward_type${newCount}" name="reward[]" class="form-control @error('reward_type') is-invalid @enderror" required data-error="Description of Reward is required" placeholder="Description of Reward" value="{{ old('reward[]') }}"  />
                                                        @error('reward_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
            </div>
        </div>

        <div class="col-sm-12 hidden amount_holder">
            <div class="form-group">
                <label for="amount">{{ __('Amount') }}</label>
                                                        <input type="text" id="amount" name="amount[]" class="form-control @error('amount') is-invalid @enderror" data-error="Amount" placeholder="Amount" value="{{ old('reward') }}"  />
                                                        @error('amount')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
            </div>
        </div>

        <div  class="col-sm-12" style="margin-bottom: 20px;">
                <button onclick="removeRewardField(this, '.reward_holder')" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-trash"></i></button>
        </div>

    </div>
</div>
`;

    //
        $(field).insertBefore('.reward_field_adder')//reward_holder_count reward_holder

    }

    function removeRewardField(a, selected) {
        $(a).closest(selected).remove();
    }
    
    async function showInvestDetails(a) {
        let unique_id = $(a).val();
        //$(a).text('Loading....').attr({'disabled':true});
        if(unique_id === ''){
            $(".amount_2_holder").addClass('hidden');
            $('.hiddenDiv').addClass('hidden');
            returnFunctions.showSuccessToaster('Please Select A Plan To Continue');
            return;
        }

        let getFormDetails = await getRequest(baseUrl+'/get_single_investment_settings/'+unique_id); console.log(getFormDetails)
        let investmentSettingDetails = getFormDetails;
        let list_of_rewards = '';
        if(investmentSettingDetails.error_code == 0){
            let details = investmentSettingDetails.data;
            let minAmount = Math.round(details.min_investment_amount * details.loggedUserCurrency.rate_of_conversion);
            let amountForForm = Math.round(details.amount_for_form * details.loggedUserCurrency.rate_of_conversion);
            let maxAmount = details.max_investment_amount_switch === 'on' ? Math.round(details.max_investment_amount * details.loggedUserCurrency.rate_of_conversion) : '';
            let duration_in_days = Math.round(details.duration_in_days);
            $("#amount_").val('('+details.loggedUserCurrency.second_currency+') '+formatMoney(minAmount, 2));
            $("#amount_for_form").val('('+details.loggedUserCurrency.second_currency+') '+formatMoney(amountForForm, 2));
            $("#duration_in_days").val(duration_in_days+ ' Days');
            if(maxAmount !== ''){
                $("#amount_2").val('('+details.loggedUserCurrency.second_currency+') '+formatMoney(maxAmount, 2));
                $(".amount_2_holder").removeClass('hidden');
            }else{
                $("#amount_2").val('');
                $(".amount_2_holder").addClass('hidden');
            }


            //get the rewards
            if(details.rewards_details.length > 0){
                list_of_rewards += '<h4>List of Rewards for this Plan</h4>'
                var rewardDetailss = details.rewards_details;
                for(var i in rewardDetailss){
                    if(rewardDetailss[i].reward_type === 'cash'){
                        let reward_amount = Math.round(rewardDetailss[i].amount*details.loggedUserCurrency.rate_of_conversion);
                        list_of_rewards+=`<ul>
                <li><span style="color:darkred;">* </span><span>${'Earn ('+details.loggedUserCurrency.second_currency+') '+reward_amount+' in '+duration_in_days+' days'}</span></li>
            </ul>`;

                    }else {
                        list_of_rewards+=`<ul>
                <li><span style="color:darkred;">* </span><span>${rewardDetailss[i].reward}</span></li>
            </ul>`
                    }

                }
                $(".list_of_rewards").html(list_of_rewards)
            }

            //duration amount_ amount_holder duration_holder
            $('.hiddenDiv').removeClass('hidden');
        }

        if(investmentSettingDetails.error_code == 1){
            $('.hiddenDiv').addClass('hidden');
            $('#.amount_2_holder').addClass('hidden');
        }

    }
    
    function addNewVideoField() {
        let field = `
            <div class="form-group row">
            <div  class="col-sm-10" style="margin-bottom: 5px;">
                <input type="text" name="video_url[]" class="form-control @error('description') is-invalid @enderror" placeholder="Video Url Example: https://example.com or https://wwww.example.com">
                </div>
                <div  class="col-sm-2" style="margin-bottom: 5px;">
                <button onclick="removeRewardField(this, '.form-group')" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-trash"></i></button>
        </div>
            </div>
        `
        $(field).insertBefore('.video_field_adder');
    }

</script>
@php $pageArray = ['show_top_up_transactions', 'main_settings_page', 'settings_page', 'editProfile', 'wallet', 'investments_settings', 'create_gallery_view', 'compose', 'add_funds'];  @endphp
@if(@in_array( request()->segment(1), $pageArray))
<script>
    $(document).ready(function () {
        showErrors();
    });
</script>
@endif

{{--testimony reminder--}}
@php $pageTestimonyArray = ['home'];  @endphp
@if(@in_array( request()->segment(1), $pageTestimonyArray))
@if(auth()->user()->checkUserTestimonyStatus() === 'review' && auth()->user()->type_of_user === 'user')
    <script>
        $(document).read(function () {
            $('.testmony-update').modal({ backdrop: 'static', keyboard: false });
        })
    </script>
@endif
@endif


@php $pageBanksArray = ['create_center_page', 'edit_center_page'];  @endphp
@if(@in_array( request()->segment(1), $pageBanksArray))
<script>
$(document).ready(function () {
    let selected_bank = $("#selected_bank").val();
    let banks = getBanks(selected_bank);
    $("#bank_code").html(banks);
})

function dropBankName(a) {
    let selectedValue = $(a).find("option:selected").text();

    $(a).siblings('.bank_name').val(selectedValue)
}

</script>
@endif

@include('js_files.user_account_manager')

<!-- 3. Instantiate clipboard -->
<script>
    var clipboard = new ClipboardJS('.copybtn');

    clipboard.on('success', function(e) {
        returnFunctions.showSuccessToaster('Copied!!!', 'success');

        /*e.clearSelection();*/
    });

    clipboard.on('error', function(e) {
        returnFunctions.showSuccessToaster('Copy failed', 'warning');
    });

    function addNewFaqsField(){

        let faqs_fields_holder = $('.faqs_fields_holder');
        let TotalLength = faqs_fields_holder.length;
        let newCount = 0;
        for(let i = 0; i < TotalLength; i++){
            let lastValue = parseFloat(TotalLength)-parseFloat(1);
            if(parseFloat(i) == lastValue){
                let lastCount = $(faqs_fields_holder[i]).attr('data-count-holder');
                newCount = parseFloat(lastCount) + parseFloat(1);
            }
        }


        let field = `
            <div class="col-12 faqs_fields_holder" data-count-holder="${newCount}">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 >${newCount})</h5>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title_">Question</label>
                                                    <input type="text" id="question" name="question[]" class="form-control" placeholder="Question"  />
                                                </div>
                                                @error('question.1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="summernote1">Answer</label>
                    <textarea id="summernote1" class="form-control" style="height: auto !important;" name="answers[]" placeholder="Enter Answers To The Question Above Here"></textarea>
                </div>
            </div>

            <div  class="col-sm-12" style="margin-bottom: 20px;">
                <button onclick="removeRewardField(this, '.faqs_fields_holder')" type="button" class="btn guoBtn" title="Add new fields for reward"><i class="fa fa-trash"></i></button>
        </div>

        </div>
    </div>

`
        $(field).insertBefore('.faqs_field_adder');

    }

    //update he support badge
    async function updateSupport(a){
        let retVal = confirm('Do you really want to delete selected messages');
        if(retVal === true){
            let selected = $(".smallCheckBox");
            let dataArray = [];
            for(let i = 0; i < selected.length; i++){
                if($(selected[i]).is(':checked')){
                    dataArray.push($(selected[i]).val());
                }
            }

            $(a).text('Loading...').attr({'disabled':true});

            if(dataArray.length == 0){
                returnFunctions.showSuccessToaster('Please select at least one message to continue', 'warning');
                $(a).html("<i class='bx bx-trash'></i>").attr({'disabled':false});
                return;
            }

            let postData = await postRequest("{{route('handle_message_delete')}}", {dataArray:dataArray});

            if(postData.error_code == 0){
                $(a).html("<i class='bx bx-trash'></i>").attr({'disabled':false});
                returnFunctions.showSuccessToaster(postData.success_statement, 'success');
                setTimeout(function () {
                    location.reload();
                }, 5000);
                return;

            }
            handleTheErrorStatement(postData.error_message, 'off', 'no', 'yes');
        }
    }

    $(document).ready(function () {
        supportNotifier();
    })
    
    async function supportNotifier() {

        //
        let postData = await getRequest("{{route('get_support_notification')}}");

        let {count} = postData;

        $(".notifier_class").html(`<i class='bx bx-support'></i><span>Support <sup class="badge-info badge" style="color:white;">${count}</sup></span>`);

    }


</script>

@php $pageChartArray = ['home'];  @endphp
@if(@in_array( request()->segment(1), $pageChartArray))
    <script>

        // Apex Donut chart start
        let dataArrays = [{{$getActiveInvestments->count()}},  {{$DueInvestments->count()}}, {{$getAmountGotFromInvestment->count()}}];
        //let dataArrays = [2, 0, 0];

        var options = {
            chart: {
                height: 300,
                type: "donut"
            },
            stroke: {
                colors: ['rgba(0,0,0,0)']
            },
            colors: ["#6610f2", "#7ee5e5", "#4d8af0"],//, "#fbbc06"
            legend: {
                position: 'top',
                horizontalAlign: 'center'
            },
            dataLabels: {
                enabled: false
            },
            series:dataArrays
        };

        var chart = new ApexCharts(document.querySelector("#grandourChart"), options);

        chart.render();
        // Apex Donut chart start
    </script>
@endif

<!--Start of Tawk.to Script-->
{{--<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5fc0882e920fc91564cb1ffc/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>--}}
<!--End of Tawk.to Script-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5fc8ae55a1d54c18d8eff1da/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->









