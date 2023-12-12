<div class="row justify-content-md-center">
	<div class="col-md-4">

		<?php if ($this->session->flashdata('msg')) : ?>
			<?= $this->session->flashdata('msg') ?>
		<?php endif ?>
	<div class="card">
  <div class="card-body">

  	<div class="row justify-content-end">
 	 <div class="col-4 ">
 		<div class="d-flex justify-content-end">
		<!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambah_barang">
<i class="material-icons opacity-10">add_circle</i>
</button>
 		</div>

 		</div>

 	</div>

  <table id="myTable" class="display">
    <thead>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
		<?php $i = 1 ?>
		<?php foreach ($barang as $b) : ?>
				<tr>
            <td><?= $i ?></td>
            <td><?= $b->nama_barang ?></td>
            <td><a href="<?= base_url("dashboard/hapus_barang/".$b->id) ?>" class="btn btn-primary" onclick="return confirm('apakah anda yakin?')"> <i class="material-icons opacity-10">delete</i></a>
						<button type="button" class="btn btn-info edit" data-bs-toggle="modal" data-bs-target="#edit_barang" onclick="get_barang(<?= $b->id ?>)">
						<i class="material-icons opacity-10">edit</i>
					</button>
					</td>
        </tr>
		<?php $i++ ?>
		<?php endforeach ?>
    </tbody>
</table>
  </div>
</div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="tambah_barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Nama Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <form action="<?= base_url("dashboard/tambah_barang") ?>" method="POST">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" autocomplete="off">
                  </div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">ADD</button>
	</form>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="edit_barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Nama Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		  
	  <form action="<?= base_url("dashboard/edit_barang") ?>" method="POST">
                  <div class="input-group input-group-outline my-3">
                    <!-- <label class="form-label">Nama Barang</label> -->
					<input type="text" id="edit_nama_barang" class="form-control p-3" placeholder="nama barang..." name="nama_barang" autocomplete="off">
					<input type="hidden" id="barang_id" name="id">
                  </div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Edit</button>
	</form>
      </div>
    </div>
  </div>
</div>
