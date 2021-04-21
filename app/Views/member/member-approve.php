<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
					<h6 class="m-0 font-weight-bold text-primary">รายชื่อสมาชิกรออนุมัติ</h6>

				</div>
				<!-- Card Body -->

				<div class="card-body">

					<table class="table">
						<thead>
							<tr>
									<th scope="col">ID</th>
									<th scope="col">ชื่อสมาชิก</th>
									<th scope="col">Email</th>
									<th scope="col">วันที่สมัคร</th>
									<th scope="col">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $item) : ?>
								<tr>
									<th><?= $item['member_id']; ?></th>
									<td><?= $item['firstname']; ?></td>
									<td><?= $item['member_email']; ?></td>
									<td><?= $item['created_at']; ?></td>
									<td>
										<a class="btn btn-success chra" style="color :#FFF" data-id="<?= $item['member_id']; ?>" data-toggle="modal" data-target="#requestInfo" aria-label="Close" role="button"><i class="fas fa-eye"></i></a>
										<a class="btn btn-warning" value="<?= $item['firstname']; ?>" onclick="confirmApprove(event)" href="<?= base_url(); ?>/admin/approvemember/<?= $item['member_id']; ?>" role="button"><i class="fas fa-check"></i></a>
										<a class="btn btn-danger" value="<?= $item['firstname']; ?>" onclick="confirmDelete(event)" href="<?= base_url(); ?>/admin/banmember/<?= $item['member_id']; ?>" role="button"><i class="fas fa-times"></i></a>


									</td>
								</tr>
							<?php endforeach; ?>

							<!-- modal -->
							<div class="container">
								<div class="modal fade" id='requestInfo' role='dialog'>
									<div class="modal-dialog modal-lg">

										<div class="modal-content">
											<div class="modal-header">
												<h4 class="col-12 modal-title text-center">รายละเอียดสมาชิก</h4>
												<button type='button' class='close' data-dismiss='modal'>&times;</button>
											</div>
											<div class="modal-body"></div>
											<!-- <div class="modal-footer">
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<!-- end modal -->


						</tbody>
					</table>
				</div>
			</div>
		</div>



	</div>

</div>


<script>
	function confirmDelete(ev) {
		ev.preventDefault();
		var urlToRedirect = ev.currentTarget.getAttribute('href');
		var name = ev.currentTarget.getAttribute('value');
		console.log(urlToRedirect);
		Swal.fire({
			title: ' การอนุมัติ',
			text: ' ไม่อนุมัติ ' + name + ' ?',
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

	function confirmApprove(ev) {
		ev.preventDefault();
		var urlToRedirect = ev.currentTarget.getAttribute('href');
		var name = ev.currentTarget.getAttribute('value');
		console.log(urlToRedirect);
		Swal.fire({
			title: 'การอนุมัติ',
			text: ' ต้องการอนุมัติ  ' + name + ' ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#5cb85c',
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
		$('.chra').click(function() {
			var reqid = $(this).data('id');
			$.ajax({
				url: '<?php echo site_url(); ?>admin/getmember',
				type: 'post',
				data: {
					reqid: reqid
				},
				success: function(response) {
					//   alert(response)
					$('.modal-body').html(response);
					$('#requestInfo').modal('show');
				}
			})
		})
	});
</script>