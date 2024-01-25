<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
{{-- <script src="{{ asset('assets/index/js/wow.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/index/js/jquery.nicescroll.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/cards-search.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>

<script type="text/javascript">
    $('#search').on('keyup', function(){
        // alert('hello');
        $Svalue=$(this).val();
        // alert($Svalue);
        $.ajax({
            type: 'get',
            url: '{{ URL::to('search') }}',
            data: {'search':$Svalue},

            // success:function(data){
            //     console.log(data);
            //     $('#Contents').html(data);
            // }
        });
    })

    $(document).ready(function () {

        $('#allBooks_tbl').dataTable({
            "pageLength": 10,
            "responsive": true,
            "autoWidth": true,
            "order": [[ 2, 'asc' ]],
        });
        $('#allCategories_tbl').dataTable({
        "pageLength": 10,
        "responsive": true,
        "autoWidth": true,
        "order": [[ 1, 'asc' ]],
        });/*
        $('#viewtbl').dataTable({
            "pageLength": 50,
            "responsive": true,
            "autoWidth": true,
        });*/
        $('#example').DataTable();

        setTimeout(function () {
        
        // Closing the alert
        $('#alert').alert('close');
        }, 4000);
    });
    
</script>

{{-- ? TOAST --}}
<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif
    
    
    @if(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
    @endif
    
    
    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");
    @endif
    
    
    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif
</script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->