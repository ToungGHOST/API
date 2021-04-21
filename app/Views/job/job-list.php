<div class="container-fluid">
	<div class="row">

		<div class="col-xl-12">
			<?php if (!empty(session()->getFlashdata('notification-success'))) { ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?php echo session()->getFlashdata('notification-success'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
			<?php } ?>
			<?php if (!empty(session()->getFlashdata('notification-danger'))) { ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php echo session()->getFlashdata('notification-danger'); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
			<?php } ?>
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">รายชื่อประกาศ</h6>

				</div>
				<!-- Card Body -->

				<div class="card-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>

									<th scope="col">ID</th>
									<th scope="col">ชื่อประกาศ</th>
									<th scope="col">ชื่อบริษัท</th>
									<th scope="col">วันลงประกาศ</th>
									<th scope="col">จัดการ</th>

								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $item) : ?>
									<tr>
										<th><?= $item['job_id']; ?></th>
										<td><?= $item['job_name']; ?></td>
										<td><?= $item['cou_name_th']; ?></td>
										<td><?= $item['created_at']; ?></td>
										<td>
											<!-- /<button data-id=""class="btn btn-info chjreq">ตรวจสอบ</button> -->
											<a class="btn btn-success chreq" style="color :#FFF" data-id="<?= $item['job_id']; ?>" data-toggle="modal" data-target="#requestInfo" aria-label="Close" role="button"><i class="fas fa-eye"></i></a>
											<a class="btn btn-warning" value="<?= $item['job_name']; ?>" onclick="confirmBan(event)" href="<?php echo site_url(); ?>/admin/banjob/<?= $item['job_id']; ?>" role="button"><i class="fas fa-ban"></i></a>
											<a class="btn btn-danger" value="<?= $item['job_name']; ?>" onclick="confirmDelete(event)" href="<?= base_url(); ?>/admin/deletejob/<?= $item['job_id']; ?>" role="button"><i class="fas fa-trash"></i></a>


										</td>
									</tr>
								<?php endforeach; ?>
								<div class="container">
									<div class="modal fade" id='requestInfo' role='dialog'>
										<div class="modal-dialog modal-lg">

											<div class="modal-content">
												<div class="modal-header">
													<h4 class="col-12 modal-title text-center">รายละเอียดประกาศ</h4>
													<button type='button' class='close' data-dismiss='modal'>&times;</button>
												</div>
												<div class="modal-body"></div>
											</div>
										</div>
									</div>
								</div>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
	function confirmDelete(ev) {
		ev.preventDefault();
		var urlToRedirect = ev.currentTarget.getAttribute('href');
		var name = ev.currentTarget.getAttribute('value');
		console.log(urlToRedirect);
		Swal.fire({
			title: ' ยืนยันการลบ',
			text: ' ต้องการลบ ' + name + ' ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'ยืนยัน',
			cancelButtonText: 'ยกเลิก'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = urlToRedirect;

			}
		})
	}

	function confirmBan(ev) {
		ev.preventDefault();
		var urlToRedirect = ev.currentTarget.getAttribute('href');
		var name = ev.currentTarget.getAttribute('value');
		console.log(urlToRedirect);
		Swal.fire({
			title: ' ยืนยันการแบน',
			text: ' ต้องการแบน ' + name + ' ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'ยืนยัน',
			cancelButtonText: 'ยกเลิก'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = urlToRedirect;

			}
		})
	}
</script>
<script type="text/javascript">
	$().ready(function() {
		// console.log("reqid")
		$('.chreq').click(function() {
			var reqid = $(this).data('id');
			//   console.log(reqid)
			$.ajax({
				url: '<?php echo site_url(); ?>admin/getjob',
				type: 'post',
				data: {
					reqid: reqid
				},
				success: function(response) {
					// console.log(response)
					$('.modal-body').html(response);
					$('#requestInfo').modal('show');
				}
			})
		})
	});
</script>