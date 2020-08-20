  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0 <!-- <small><i>created by thor</i></small> -->
    </div>
    <strong>Copyright &copy; 2020 <a target="_blank" href="">Sistem Informasi</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- <script>
  $(document).ready(function() {
    var max = 0;
    var x = 0;
    var maxsub = 0;
    $.each($('.linksamping'), function(index) {
      max = Math.max(index);
      $.each($('.submenu'), function(subindex) {
        $('#submenu'+index+subindex).on('click', function(e) {
          e.preventDefault();
          var link = $(this).data('recid');
          console.log(link);
          switch(link) {
            case 'coba':
              $('#menu0').removeClass('active');
              $('#menu'+index).addClass('active');
              $('#utama').html('wah kita coba ya');
              break;

            case 'cobanen':
              $('#utama').html('waduh bisa juga dong');
              break;

            case 'dashboard':
              $.ajax({
                url: 'index.php',
                type: 'get',
                success: function(response) {
                  $('#utama').html(response);
                },
                error: function(error) {
                  console.log(error);
                }
              })
          }
        })
        console.log(index+'-'+subindex);
      })
    })
  })
</script> -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
</body>
</html>