<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} - Failed Transaction Page</title>
</head>
<style>
    .main_cover{
        width:100%;
        height: 100vh;
        background-color: #120136;
        float: left;
    }
    .text-center{
        text-align: center;
    }
    .main_font{
        font-family: "Century Gothic";
    }
    .color_set{
        color:#b80d57;
    }
    .carrier{
        margin-top: 200px; width: 30%; padding: 40px 0px; margin-left: 35%; height: auto; background: #40bad5;
    }
    .image-resp{
        width: 50px;
    }
    @media (max-width: 767px) {
        .main_cover{
            width:100%;
            height: 100vh;
            background-color: #120136;
            float: left;
        }
        .text-center{
            text-align: center;
        }
        .main_font{
            font-family: "Century Gothic";
        }
        .color_set{
            color:#b80d57;
        }
        .carrier{
            margin-top: 100px; width: 90%; padding: 0px 0px; margin-left: 5%; height: auto; background: #40bad5;
        }
        .image-resp{
            width: 50px;
        }
    }
    @media (min-width: 768px) {
        .main_cover{
            width:100%;
            height: 100vh;
            background-color: #120136;
            float: left;
        }
        .text-center{
            text-align: center;
        }
        .main_font{
            font-family: "Century Gothic";
        }
        .color_set{
            color:#b80d57;
        }
        .carrier{
            margin-top: 150px; width: 80%; padding: 0px 0px; margin-left: 10%; height: auto; background: #40bad5;
        }
        .image-resp{
            width: 50px;
        }
    }
    @media (min-width: 1200px) {
        .main_cover{
            width:100%;
            height: 100vh;
            background-color: #120136;
            float: left;
        }
        .text-center{
            text-align: center;
        }
        .main_font{
            font-family: "Century Gothic";
        }
        .color_set{
            color:#b80d57;
        }
        .carrier{
            margin-top: 150px; width: 60%; padding: 20px 0px; margin-left: 20%; height: auto; background: #40bad5;
        }
        .image-resp{
            width: 50px;
        }
    }
</style>
<body style="margin: 0px;">

    <div class="main_cover">
        <div class="carrier">
            <p class="text-center main_font" style="color:white;">
            @php //$mainSettings = \App\Models\AppSettings::getSingleModel() @endphp
            <center><img src="{{$mainSettings->logo_url}}" class="image-resp" /></center>
            </p>

            <h2 class="text-center main_font" style="color:white;">{{$mainSettings->site_name}}</h2>

            <div class="text-center main_font color_set">
                <div class="col-lg-6  col-lg-offset-3">
                    @if (session('success_status'))
                        <p class="alert alert-success" style="color:black;">
                            {{ session('success_status') }}
                        </p>
                    @endif
                    @if (session('error_status'))
                        <p class="alert alert-danger" style="color:black;">
                            {{ session('error_status') }}
                        </p>
                    @endif
                </div>
            </div>
            <p class="text-center main_font" style="color:white;">Your Payment Could Not Be Verified</p>
            <div class="text-center main_font" style="color:white;">
                <a href=""></a>
            </p>
        </div>
    </div>

</body>
</html>
