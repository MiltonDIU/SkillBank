@push('styles')
<link rel="stylesheet" type="text/css" href="{{url('assets/notification/toastr.css')}}">
@endpush
@push('scripts')
<script src="{{url('assets/notification/toastr.min.js')}}"></script>
<script type="text/javascript">
    @if(Session::has('notification'))
    //alert("{{ Session::get('notification.alert-type') }}");
    var type = "{{ Session::get('notification.alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('notification.message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('notification.message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('notification.message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('notification.message') }}");
            break;
    }
    @endif
</script>
@endpush
