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
					<h6 class="m-0 font-weight-bold text-primary">รายชื่อผู้ดูแลระบบ</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">

					<table class="table">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Firstname</th>
								<th scope="col">Email</th>
								<th scope="col">Date Register</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $item) : ?>
								<tr>
									<th><?= $item['id']; ?></th>
									<td><?= $item['firstname']; ?></td>
									<td><?= $item['admin_email']; ?></td>
									<td><?= $item['create_at']; ?></td>
									<td>
										<a class="btn btn-warning" href="<?php echo site_url(); ?>admin/editadmin/<?= $item['id']; ?>" role="button"><i class="fas fa-edit"></i></a>
										<a class="btn btn-danger" value="<?= $item['firstname']; ?>" onclick="confirmDelete(event)" href="<?= base_url(); ?>/admin/deleteadmin/<?= $item['id']; ?>" role="button"><i class="fas fa-trash"></i></a>
									</td>
								</tr>
							<?php endforeach; ?>


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
</script>