<footer class="d-flex justify-content-center bg-dark align-items-center">
  <p class="text-light my-4 small">@ 2021 Sistem Pemesanan UKM Desa Tombolo. All Right Reserved.</p>
</footer>
<!-- <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{asset('template/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/assets/js/templatemo.js')}}"></script>
<script src="{{asset('template/assets/js/custom.js')}}"></script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.23.0/axios.min.js" integrity="sha512-Idr7xVNnMWCsgBQscTSCivBNWWH30oo/tzYORviOCrLKmBaRxRflm2miNhTFJNVmXvCtzgms5nlJF4az2hiGnA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
@yield('script')
</body>

</html>