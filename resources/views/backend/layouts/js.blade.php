<script src="{{ asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{ asset('/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{ asset('/assets/js/plugins/chartjs.min.js')}}"></script>
<script src="{{ asset('/js/image-lightbox.js')}}"></script>
<script src="{{ asset('/js/halkaBox.min.js')}}"></script>
<script src="{{ asset('/assets/js/argon-dashboard.min.js?v=2.0.4')}}"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
        damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
