<footer class="d-flex justify-content-center bg-dark align-items-center">
  <p class="text-light my-4 small">@ 2021 Sistem Pemesanan UKM Desa Tombolo. All Right Reserved.</p>
</footer>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });
</script>