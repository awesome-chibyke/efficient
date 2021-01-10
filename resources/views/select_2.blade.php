<!--select 2-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<style>
    .select2-selection--single{
        height: 50px !important;
        padding-top: 10px !important;
        padding-left: 10px !important;
        border-color: var(--blackColor) !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 28px;
        font-weight: bold;
    }
    input.select2-search__field{
        color:black !important;
    }
</style>