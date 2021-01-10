
<!-- jquery latest version -->
<script src="{{asset('black_theme/js/vendor/jquery-1.12.4.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('black_theme/js/bootstrap.min.js')}}"></script>
<!-- Form validator js -->
<script src="{{asset('black_theme/js/form-validator.min.js')}}"></script>
<!-- plugins js -->
<script src="{{asset('black_theme/js/plugins.js')}}"></script>
<script>
    function showErrors() {
        var selected = $(".invalid-feedback");
        for(let i = 0; i < selected.length; i++){
            if($(selected[i]).find('strong').text() !== ''){
                $(selected[i]).css({'display':'block'});
            }
        }
    }
</script>