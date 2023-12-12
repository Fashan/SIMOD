<footer class="footer py-4  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          © <script>
            document.write(new Date().getFullYear())
          </script>,
          create by 
          <a href="#" class="font-weight-bold" target="_blank">Fashan Saraya</a>
          for better life.
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="#" class="nav-link text-muted" target="_blank">Shan Team</a>
          </li>
          
        </ul>
      </div>
    </div>
  </div>
</footer>
</div>
  </main>
  <!--   Core JS Files   -->
  <script src="<?= base_url("assets/js/core/popper.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/core/bootstrap.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/plugins/perfect-scrollbar.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/plugins/smooth-scrollbar.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/plugins/chartjs.min.js") ?>"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
	<script src="<?= base_url("/vendor/eternicode/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") ?>"></script>

	<script>
		var base_url = '<?= base_url() ?>';
		$(document).ready( function () {
    $('#myTable').DataTable();
} );


$('.datepicker').datepicker(
	{
		format: 'yyyy-mm-dd',
	}
);

function get_barang(id){	
	$.ajax({
    type: "post",
    url: base_url + "dashboard/get_barang",
    data: "id="+id,
    dataType: "json",
    success: function (barang) {
			console.log(barang);
        $('#edit_nama_barang').val(barang.nama_barang);
        $('#barang_id').val(barang.id);
    }
});
}

  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

<script type="text/javascript">
 

	// fungsi jam

	var ms = 0, s = 0, m = 0, h = 0;
	var timer;
   
	var stopwatchEl = document.querySelector('.stopwatch');
	var lapsContainer = document.querySelector('.laps');
   
   start();
   
	function start() {
	   if(!timer) {
		timer = setInterval(run, 10);
	   }
	}
   
	function run() {
	   stopwatchEl.textContent = getTimer();
	   ms++;
	   if(ms == 100) {
		ms = 0;
		s++;
	   }
	   if(s == 60) {
		s = 0;
		m++;
		
		
	   }
	   if(m == 60) {
		m = 0;
		h++;
		set_notification();
	   }
	  
	}
         
	function getTimer() {
	   return (h < 10 ? "0" + h : h)+":"+(m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s);
	}
 
start();

function set_notification(){
	let notification = '';

	$('#icon_notif').css('color','darkblue');
		$('#icon_notif').click(function (e) { 
			e.preventDefault();
			$('#icon_notif').css('color','');
		});
		
		$.ajax({
			type: "post",
			url: base_url+"sensor/data_notification",
			data: "",
			dataType: "json",
			success: function (response) {
		notification += '<li class="mb-2">';
		notification += '<a class="dropdown-item border-radius-md" href="javascript:;">';
		notification += '<div class="d-flex py-1">';
		notification += '<div class="my-auto">';
		notification += '<img src="'+base_url+'assets/img/simod-logo.jpeg'+'" class="avatar avatar-sm  me-3 ">';
		notification += '</div>';
		notification += '<div class="d-flex flex-column justify-content-center">';
		notification += '<h6 class="text-sm font-weight-normal mb-1">';
		notification += '<span class="font-weight-bold">from SIMOD</span> Anda telah menggunakan daya selama '+h+' jam,';
		notification += ' daya yang digunakan:';
		notification += ' </h6>';
		notification += ' <p class="h6 text-xs text-dark mb-0">';
		notification += ' <i class="fa fa-bolt me-1"></i>';
		notification += response.barang1 +':'+ (response.energi1 * h) +'  Kwh';
		notification += ' </p>';
		notification += ' <p class="h6 text-xs text-dark mb-0">';
		notification += ' <i class="fa fa-bolt me-1"></i>';
		notification += response.barang2 +':'+ (response.energi2 * h) +'  Kwh';
		notification += ' </p>';
		notification += '</div>';
		notification += '</div>';
		notification += '</a>';
		notification += '</li>';
		// notification += '';

	$('#list_notif').append(notification);
			}
		});

}

function delete_notification(){
	$('#list_notif').html('<button type="button" class="btn btn-sm btn-info" onclick="delete_notification()">clear</button>');
}


</script>

<script src="<?= base_url("assets/ajax/grafik.js") ?>"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url("assets/js/material-dashboard.min.js?v=3.0.3") ?>"></script>
</body>

</html>
