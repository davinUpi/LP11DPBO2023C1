<?php


include_once("kontrak/KontrakPasien.php");
include_once("presenter/ProsesPasien.php");

class TampilPasien implements KontrakPasienView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	public function index(){

		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete'])){
			$this->prosespasien->deletePasien($_POST['id']);
		}
		$this->tampil();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<input type='hidden' value=".$this->prosespasien->getId($i)." name = 'id'>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
			<td>
				<button type='submit' name='delete'>delete</button> 
				<a href='update.php?id=".$this->prosespasien->getId($i)."'><button type='button'>update</button></a>
			</td>
			</tr>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}
}
