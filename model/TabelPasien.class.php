<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}

	function insertPasien($data){
		$nik = trim($data['nik']);
		$nama = trim($data['nama']);
		$tempat = trim($data['tempat']);
		$tl = trim($data['tl']);
		$gender = trim($data['gender']);
		$email = trim($data['email']);
		$telp = trim($data['telp']);

		$query = "INSERT INTO pasien(nik, nama, tempat, tl, gender, email, telp) values ('$nik','$nama', '$tempat', '$tl', '$gender', '$email', '$telp') ";
		echo $query;
		$this->execute($query);
		if(mysqli_affected_rows($this->db_link) > 0){
			echo '<script>alert("inserted!")</script>';
		}
		else{
			echo '<script>alert("Failed!")</script>';
		}
	}

	function updatePasien($id, $data){
		$nik = trim($data['nik']);
		$nama = trim($data['nama']);
		$tempat = trim($data['tempat']);
		$tl = trim($data['tl']);
		$gender = trim($data['gender']);
		$email = trim($data['email']);
		$telp = trim($data['telp']);

		$query = "UPDATE pasien SET nik = '$nik' , nama = '$nama' , tempat = '$tempat' , tl = '$tl' , gender = '$gender' , email = '$email' , telp = '$telp' WHERE id = $id";
		$this->execute($query);
		if(mysqli_affected_rows($this->db_link) > 0){
			echo '<script>alert("updated!")</script>';
		}
		else{
			echo '<script>alert("Failed!")</script>';
		}
	}

	function deletePasien($id){
		$query = "DELETE FROM pasien WHERE id =".$id;
		$this->execute($query);
		if(mysqli_affected_rows($this->db_link) > 0){
			echo '<script>alert("deleted!")</script>';
		}
		else{
			echo '<script>alert("Failed!")</script>';
		}
	}
}
