<footer class="d-flex justify-content-center bg-dark align-items-center">
  <p class="text-light my-4 small">@ 2021 Sistem Pemesanan UKM Desa Tombolo. All Right Reserved.</p>
</footer>
<!-- <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script> -->
<script src="{{asset('template/assets/js/jquery-1.11.0.min.js')}}"></script>
<script src="{{asset('template/assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('template/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/assets/js/templatemo.js')}}"></script>
<script src="{{asset('template/assets/js/custom.js')}}"></script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });
</script>
@yield('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>