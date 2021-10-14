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
@hasrole('admin')
<script>
     function resetData() {
    const URL_NOW = `{{ request()->url() }}`;
    Swal.fire({
        title: 'Yakin?',
        text: "Data yang akan direset adalah user, ukm, rate, review, dan produk",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya!'
      })
      .then((result) => {
        if (result.isConfirmed) {
          new Promise((resolve, reject) => {
            var url = `reset_data`;
            axios.post(`/admin/${url}`)
              .then(({
                data
              }) => {
                Swal.fire({
                  icon: 'success',
                  title: data.message.head,
                  text: data.message.body
                }).then((result)=>{
                  if (result.isConfirmed) {
                   window.location.replace(location.pathname);
                  }
                })
              })
              .catch(err => {
                let data = err.response.data
                Swal.fire({
                  icon: 'error',
                  title: data.message.head,
                  text: data.message.body
                })
              })
          });

        }
      });
  }
</script>
@endhasrole
@yield('script')
</body>

</html>