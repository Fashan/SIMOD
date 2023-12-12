<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="<?= base_url("assets/img/simod-logo.jpeg") ?>">
	<title>Laporan Penggunaan</title>
	<style>
	table {
            border-collapse: collapse;
            width: 50%;
        }
 
        /* table, th, td {
            border: 1px solid black;
        } */
        th, td {
            padding: 10px;
        }
        th {
            background-color: rgb(19, 110, 170);
            color: white;
        }
        tr:hover {background-color: #f5f5f5;}
</style>

</head>
<body>
	<br>
	<br>
	<br>
	
	<table style="margin-left:auto;margin-right:auto;width: 60%;">
        <tbody>
			<tr>
               <td colspan="3"  style="font-size: 25px;">laporan penggunaan listrik</td>
            </tr>
        </tbody>
        
    </table>
	<br>
	<br>
	<br>
<table style="margin-left:auto;margin-right:auto" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tegangan(V)</th>
                <th>Arus(A)</th>
                <th>Daya(Watt)</th>
                <th>Daya(Kwh)</th>
                <th>Alat Rumah</th>
                <th>jam</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
			<?php $i = 1 ?>
            <?php if ($data) : ?>
				<?php foreach ($data as $d) : ?>
					<tr>
						<td><?= $i ?></td>
						<td><?= $d->voltage ?></td>
						<td><?= $d->current ?></td>
						<td><?= $d->power ?></td>
						<td><?= $d->energy ?></td>
						<td><?= $d->nama_barang ?></td>
						<td><?= custom_date('H:i',$d->date) ?></td>
						<td><?= custom_date('d-M-Y',$d->date) ?></td>
           			</tr>
					   <?php $i++ ?>
				<?php endforeach ?>
			<?php endif ?>
        </tbody>
        
    </table>
</body>
</html>
