<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask($code){
		// Query mysql select data ke tb_to_do
		if($code == 0){
			$query = "SELECT * FROM tb_nilai_tp";
		}else if($code == 1){
			$query = "SELECT * FROM tb_nilai_tp ORDER BY nama_mhs ASC";
		}else if($code == 2){
			$query = "SELECT * FROM tb_nilai_tp ORDER BY nim_mhs ASC";
		}

		// Mengeksekusi query
		return $this->execute($query);
	}

	function addData($name , $nim, $tp1, $tp2, $tp3 ,$kelas){
		$query = "INSERT INTO tb_nilai_tp (nama_mhs , nim_mhs, kelas_mhs, tp1, tp2, tp3) VALUES ('$name', '$nim', '$kelas','$tp1', '$tp2', '$tp3');";
		
		// Mengeksekusi query
		$this->execute($query);
	}
	
	function hapus($id){
		$query = "DELETE FROM tb_nilai_tp WHERE tb_nilai_tp.id = '$id';";
		// Mengeksekusi query
		$this->execute($query);
	}

	function update_nilai($id,$par){
		if($par == 1){
			$query = "UPDATE tb_nilai_tp SET tp1 = '60'   WHERE tb_nilai_tp.id = '$id';";
		}
		else if($par == 2){
			$query = "UPDATE tb_nilai_tp SET tp2 = '60'   WHERE tb_nilai_tp.id = '$id';";
		}
		else if($par == 3){
			$query = "UPDATE tb_nilai_tp SET tp3 = '60'   WHERE tb_nilai_tp.id = '$id';";
		}
		// Mengeksekusi query
		$this->execute($query);
	}

}



?>
