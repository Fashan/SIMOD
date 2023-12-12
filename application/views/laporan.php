<div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Laporan</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
			<div class="row justify-content-center">
				<div class="col-md-6">
				<div class="d-flex justify-content-center">
					<b>Memilih tanggal untuk mencari data mingguan dan bulanan</b>
				</div>
				</div>
			</div>
				<div class="row justify-content-center mt-3">
					<div class="col-md-4">
						<form action="<?= base_url("laporan/rangedate") ?>" method="post">
						<div class="form-group">
							<label for="exampleInputEmail1">Start Date</label>
							<input type="text" class="datepicker" name="start_date" placeholder="pilih tanggal awal..." autocomplete="off">
						</div>
						
				
					</div>
					<div class="col-md-4 offset-1">
					<div class="form-group">
							<label for="exampleInputEmail1">End date</label>
							<input type="text" class="datepicker" name="end_date" placeholder="pilih tanggal akhir..." autocomplete="off">
						</div>
					</div>
				
					<div class="row justify-content-center">
				<div class="col-md-6">
				<div class="d-flex justify-content-center">
				<button type="submit" class="btn btn-primary">cari</button>
				</div>
				</div>
			</div>
					</form>
				</div>
			
			
			</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Tabel Data</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
								<div class="row justify-content-end">
									<div class="col-md-3">
									<?php if ($data) : ?>
									<form action="<?= base_url("laporan/print") ?>" method="post">
									<input type="hidden" value="<?= $start_date ?>" name="start_date">
									<input type="hidden" value="<?= $end_date ?>" name="end_date">
									<button type="submit" class="btn btn-primary">download</button></form>
									<?php endif ?>
									</div>
								</div>
                <table id="myTable" class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tegangan(V)</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Arus(A)</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Daya(Watt)</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Daya(Kwh)</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alat Rumah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jam</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data) : ?>
						<?php $i= 1 ?>
						<?php foreach ($data as $d) : ?>
					<tr>
                      <td>
                         <p class="text-sm font-weight-bold mb-0"><?= $i ?></p>
                      </td>
                      
                      <td>
					  <p class="text-sm font-weight-bold mb-0"><?= $d->voltage ?></p>
                      </td>
                      <td>
					  <p class="text-sm font-weight-bold mb-0"><?= $d->current ?></p>
                      </td>
                      <td>
					  <p class="text-sm font-weight-bold mb-0"><?= $d->power ?></p>
                      </td>
											<td>
                        <p class="text-sm font-weight-bold mb-0"><?= $d->energy ?></p>
                      </td>
                      <td>
					  <p class="text-sm font-weight-bold mb-0"><?= $d->nama_barang ?></p>
                      </td>
                      <td>
					  <p class="text-sm font-weight-bold mb-0"><?= custom_date('H:i:s',$d->date); ?></p>
                      </td>
                      <td>
					  <p class="text-sm font-weight-bold mb-0"><?= custom_date('d-M-Y',$d->date); ?></p>
                      </td>
                    </tr>
					<?php $i++ ?>					
						<?php endforeach ?>
					<?php endif ?>
                   
                   
                   
                 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
