<?php

/******************************************
TP4 IQBAL ZAIN 1901423

ITU DESKRIPSI

-------------------------------------------------------------
Saya Muhammad Iqbal Zain mengerjakan TP4PBO2021 dalam mata kuliah DPBO
untuk keberkahanNya maka saya tidak melakukan
kecurangan seperti yang telah di spesifikasikan.
Aamiin.

ITU KOMEN
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();
//$id, $tname, $tnim, $tp1, $tp2, $tp3, $tkelas
if( isset($_POST['add'])){
	$name = $_POST['tname'];
    $nim = $_POST['tnim'];
    $tp1 = $_POST['tp1'];
    $tp2 = $_POST['tp2'];
    $tp3 = $_POST['tp3'];
	$kelas = $_POST['tkelas'];
    $otask->addData($name , $nim, $tp1, $tp2, $tp3 ,$kelas);
	header("location:index.php");
}

if(isset($_GET['id_remed1'])){
	$otask->open();
	$otask->update_nilai($_GET['id_remed1'], 1);
	header("location:index.php");
}
if(isset($_GET['id_remed2'])){
	$otask->open();
	$otask->update_nilai($_GET['id_remed2'], 2);
	header("location:index.php");
}
if(isset($_GET['id_remed3'])){
	$otask->open();
	$otask->update_nilai($_GET['id_remed3'], 3);
	header("location:index.php");
}

if(isset($_GET['id_hapus'])){
	$otask->open();
	$otask->hapus($_GET['id_hapus']);
	header("location:index.php");
}


// Memanggil method getTask di kelas Task

if(isset($_GET['id_sort'])){
	$otask->open();
	$otask->getTask($_GET['id_sort']);
}else{
	$otask->getTask(0);
}

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tname, $tnim, $tkelas, $tp1, $tp2, $tp3) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tnim . "</td>
		<td>" . $tkelas . "</td>";
		
	if($tp1 < 60){
		$data .= "<td>
			<button class='btn btn-danger'><a href='index.php?id_remed1=" . $id . "' style='color: white; font-weight: bold;'>". $tp1 ."</a></button>
			</td>";
	}else{
		$data .= "<td>".$tp1."</td>";
	}
	if($tp2 < 60){
		$data .= "<td>
			<button class='btn btn-danger'><a href='index.php?id_remed2=" . $id . "' style='color: white; font-weight: bold;'>". $tp2 ."</a></button>
			</td>";
	}else{
		$data .= "<td>".$tp2."</td>";
	}
	if($tp3 < 60){
		$data .= "<td>
			<button class='btn btn-danger'><a href='index.php?id_remed3=" . $id . "' style='color: white; font-weight: bold;'>". $tp3 ."</a></button>
			</td>";
	}else{
		$data .= "<td>".$tp3."</td>";
	}
	$data .= "<td>".strval(number_format((intval($tp1)+intval($tp2)+intval($tp3))/3,2))."</td>";
	$data .= "<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>";
	$no++;
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

$sortName = "<td>
<button style='background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;'><a href='index.php?id_sort=1' >NAMA</a></button>
</td>";
$sortNIM = "<td>
<button style='background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;'><a href='index.php?id_sort=2' >NIM</a></button>
</td>";

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("NamaSorting", $sortName);
$tpl->replace("NimSorting", $sortNIM);
// Menampilkan ke layar
$tpl->write();