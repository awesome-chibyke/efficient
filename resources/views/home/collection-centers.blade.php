<?php
$active1 = 'active';
$title = 'Collection Centers | Grandour Empowerment Programme';
$description = 'Grandour runs a contributive collaboration model of Empowerment. It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthropy.';
$keywords = 'Grandour, Empowerment, Programme, Wealth and Capacity building, Techo Craft, Contribution, Investment, Nigeria, Enugu, Anambra, Lagos';
?>
@include('fincludes.head')
    <body>

        <!-- Start Navbar Area -->
        @include('fincludes.nav')
        <!-- End Navbar Area -->

        <!-- Start Page Title Area -->
        <section style="background-image: url(image/program-cover.png); background-repeat: no-repeat; background-size: cover; background-position: center;" class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h1>Collection Centers</h1>
                </div>
            </div>

            <div class="shape1"><img src="{{asset('main/assets/img/shape/shape1.png')}}" alt="image"></div>
            <div class="shape2"><img src="{{asset('main/assets/img/shape/shape2.png')}}" alt="image"></div>
            <div class="shape3"><img src="{{asset('main/assets/img/shape/shape3.png')}}" alt="image"></div>
            <div class="shape4"><img src="{{asset('main/assets/img/shape/shape4.png')}}" alt="image"></div>
            <div class="shape5"><img src="{{asset('main/assets/img/shape/shape5.png')}}" alt="image"></div>
            <div class="shape6"><img src="{{asset('main/assets/img/shape/shape6.png')}}" alt="image"></div>
            <div class="shape7"><img src="{{asset('main/assets/img/shape/shape7.png')}}" alt="image"></div>
            <div class="shape8"><img src="{{asset('main/assets/img/shape/shape8.png')}}" alt="image"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </section style="background-image: url(image/program.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
        <!-- End Page Title Area -->

        <!-- Start About Area -->
        <section class="about-area pb-100 pt-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="about-content">
                            <div class="text">
                                <h3>GRANDOUR OFFICES/ PICK UP CENTRES IN NIGERIA</h3>

                                @if(count($collectionsCenters) > 0)
                                    @foreach($collectionsCenters as $k=> $centers)
                                        <h4 style="color:var(--mainColor); border-bottom: 2px solid var(--mainColor);">{{ucwords($k)}}</h4>
                                        @foreach($centers as $k => $eachCenter)

                                    <p><h5>{{strtoupper($eachCenter->team)}}</h5>{{strtoupper($eachCenter->address)}} {{strtoupper($eachCenter->city_town)}}, {{strtoupper($eachCenter->state_region_province)}}, {{strtoupper($eachCenter->country)}} <br>{{$eachCenter->phone1}}<br>{{$eachCenter->phone2}}

                                    <hr></p>
                                        @endforeach
                                    @endforeach
                                @endif

                                {{--<p><h3>BAYELSA TEAM INNOCENTIAL(OLUCHI)</h3>

                                No 2 Tamic  Road Okutukutu Yenagoa Bayelsa state.
                                </br>08038062201.<hr></p>

                                <p><h3>BAYELSA TEAM P</h3>
                                Johnson Printing Press 18 Otiotio road by JTF yenagoa Bayelsa State
                                <br>0803 540 0268<hr></p>

                                <p><h3>PORTHARTCOUT TEAM C</h3>
                                Address: No 25 mini avenue, before royal church, off NTA road, opposite coniol filling station, Mgbuoba portharcourt.
                                <br>+234 803 738 8902<hr></p>

                                <p><h3>AKWA IBOM (UYO) TEAM</h3>
                                UYO ADDRESS:#87 ABAK ROAD, ADJACENT TO FIDELITY BANK,UYO, AKWA IBOM STATE.
                                <br>0703 851 2020/ 0813 044 5225<hr></p>

                                <p><h3>ABA TEAM EAGLES</h3>
                                155 FAULKS ROAD.OPP.ZENITH BANK. ABA ABIA STATE.
                                <br>0802 540 6405<hr></p>

                                <p><h3>OWERRI CENTRE 2</h3>
                                Firesevives stop at Christain hospital junction Egbu, then call me. <br>08132752013<hr></p>

                                <p><h3>ENUGU TEAM SEMI CENTRE</h3>
                                NO 72  LORRY PARK, TIMBER, UGWUAJI ROAD, MARYLAND, ENUGU.
                                <br>0703 577 9959<hr></p>

                                <p><h3>WARRI TEAM C CENTRE</h3>
                                No 12 AGADAGA LAYOUT, off JAKPA ROAD EKPAN, DELTA STATE.
                                <br>0803 386 2583<hr></p>

                                <p><h3>DELTA STATE TEAM JM CENTRE</h3>
                                TRIPPLE-M PLAZA, OPPOSITE FLIGHT ALLUMINIUM ,BESIDE PRISONS HEAD QUARTERS ,ASABA/BENIN EXPRESS WAY ASABA, DELTA STATE.
                                <br>0803 821 9656<hr></p>

                                <p><h3>ABUJA TEAM RV CENTRE</h3>
                                ASO SECONDARY SCHOOL ROAD BEHIND REJAM PURE WATER MARARABA ABUJA.
                                +234 809 521 5165<hr></p>

                                <p><h3>AWKA TEAM OC CENTRE</h3>
                                Super Life plaza opposite Jessy Hotel By kwata Junction awka. Anambra state.
                                <br>+234 806 400 1816,
                                0806 739 3074<hr></p>

                                <p><h3>ONITSHA TEAM 'M' CENTRE</h3>
                                No 7 Ichida street Woliwo Onitsha, close to Tracas.
                                <br>0816 535 2855<hr></p>

                                <p><h3>OWERRI TEAM DC CENTRE</h3>
                                No 1 Tetlow road opposite Federal Mortgage bank by bank Road.
                                0704 311 6879/0803 797 2423<hr></p>

                                <p><h3>PORTHARTCOUT TEAM G CENTRE</h3>
                                39 odani road elelewo Porthartcourt.
                                <br>0703 883 2779,
                                0803 759 3307<hr></p>

                                <p><h3>LAGOS TEAM S CENTRE</h3>
                                Godsway Godsway mission compound , Ojokoro housing estate Meiran bus stop  Lagos.
                                <br>0817 366 5593<hr></p>

                                <p><h3></h3>AKUTE TEAM L CENTRE
                                addressJolasco Market Akute - Ijoko road, Jolasco Bus stop. Lagos State.
                                <br>+234 807 504 0595<hr></p>

                                <p><h3>LAGOS TEAM 'O' CENTRE</h3>
                                Alogbo close, Ahmadiyya  bustop Lagos State.
                                <br>+234 803 245 6318<hr></p>

                                <p><h3>LAGOS TEAM C</h3>
                                35 Haruna street off e road Ogba, Lagos.
                                <br>+234 818 399 6235.<hr></p>

                                <p><h3>FESTAC COLLECTION CENTRE</h3>
                                23 Road, R close House 21, Festac Town, Lagos.
                                <br>08038441028<hr></p>

                                <p><h3>LAGOS HEAD OFFICE</h3>
                                Amazing Grace Plaza Rajioba street, Alimosho
                                stop, shop 23 (STARTING SOON)<hr></p>

                                <p><h3>PORT HARCOURT TEAM U</h3>
                                #28 RUMUOLA ROAD, OPPOSITE NIKKY PLAZA
                                <br>08140513814<hr></p>

                                <p><h3>LAGOS TEAM 'I' IYANA IPAJA CENTER</h3>
                                35  new lpaja rd ,lyana lpaja roundabout beside Eco bank, lyana lpaja Lagos.  <br>08035209508, 08185092618<hr></p>

                                <p><h3>UGA TEAM</h3>
                                UGA round about by Amesi road,orie UGA.
                                <br>08066663533, 08065487172<hr></p>

                                <p><h3>NKPOR TEAM</h3>
                                4St Albert the Great Catholic Church Enugu Ozalla Street Nkpor
                                <br>08034282550<hr></p>

                                <p><h3>IBADAN TEAM RUTH CENTRE</h3>
                                Iyanu Ayo House Ajibola, Idiose Aremo Ibadan Oyo State.
                                <br>08035635530, 07035375129<hr></p>

                                <p><h3>NENI TEAM</h3>
                                Oye market by De Muna pharmacy, Neni.
                                <br>08065136739<hr></p>

                                <p><h3>2ND PICK UP CENTER IN ENUGU</h3> AT NO 11A UNIJE STREET INDEPENDENCE LAYOUT ENUGU. MRS. PRECIOUS IGWEGBE. <br>08160467775<hr></p>

                                <p><h3>TEAM ISAAC PICK UP CENTER</h3>
                                Shop 22, Omotoye Lane, Omotoye Estate Orile Agege Lagos.
                                <br>08104664995<hr></p>

                                <p><h3>UGA TEAM G CENTER</h3>
                                Opposite UGA boy's Secondary School. Beside Ogbosisi Oye UGA
                                <br>09022058816, 08061314145<hr></p>

                                <p><h3>LAGOS TEAM U EGBEDA AKWONJON PICK UP CENTER</h3> 59 FAJUMOBI STR. Mrs OWOLABI, LIFE CAMP CENTRE.<br>
                                No B18, Kingstown Estate  Life Camp New Extension, ABUJA. <br>08039758998<hr></p>

                                <p><h3>Umuahia Central Leader's</h3>35 Aba Road Umuahia, Opposite Patoria Hotel.<br> Dike Irene, <br>08136992140, 09042977874.  <hr></p>

                                <p><h3>ABUJA TEAM OBI CENTRE</h3>
                                NO 5B SANTA VIRGO STREET BEHIND SANTA VIRGO SCH.BEFORE 50_50 HOTEL KABAYI MARARBA ABUJA.<br>
                                08033741821, 08036021217<hr></p>

                                <p><h3>KETU PICK UP CENTER</h3>
                                PLOT 8C,BELLO  FOLAWIYO CRESCENT BY MR BIGGS, IKOSI ROAD KETU
                                ANGELA OJO. <br>08032488885
                                <hr></p>

                                <p><h3>PICK UP CENTRE DAVE'S TEAM KOGI STATE</h3> OPPOSITE NEW GARAGE ANKPA. <br>08037816302<hr></p>

                                <p><h3>ISOLO PICK UP CENTER</h3>  NO 23 BESTFORD AVENUE OKEAFA ISOLO LAGOS.  <br>08036251851<hr></p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        {{$paginateProps->links()}}
                    </div>





                </div>
            </div>

            <div class="shape15"><img src="{{asset('main/assets/img/shape/shape15.png')}}" alt="image"></div>
        </section>
        <!-- End About Area -->


@include('fincludes.footer')
