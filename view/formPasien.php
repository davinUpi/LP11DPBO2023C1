<?php

include_once("kontrak/KontrakPasien.php");
include_once("presenter/ProsesPasien.php");

class FormPasien implements KontrakPasienView{
    private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

    public function index(){

		if($_SERVER['REQUEST_METHOD'] == "POST"){
			if(strcasecmp(trim($_POST['crud']), "up") == 0){
                
                $this->prosespasien->updatePasien($_POST['id'], $_POST);
                header('location: index.php');
            }
            else if(strcasecmp(trim($_POST['crud']), "insert") == 0){
                $this->prosespasien->insertPasien($_POST);
                header('location: index.php');
            }
            else{
                echo '<script>alert("error");</script>';
            }
            
        }
		else{
            $this->tampil();
        }
        
		
	}

    function tampil(){
        $this->prosespasien->prosesDataPasien();
        $id = (isset($_GET['id']))?($_GET['id']):('');
        $nama = '';
        $nik = '';
        $tempat = '';
        $tl = '';
        $gender= '';
        $email ='';
        $telp = '';
        if(isset($id) && !empty($id)){
            for($i = 0; $i < $this->prosespasien->getSize(); $i++){
                if($this->prosespasien->getId($i) == $id){
                    $nama = $this->prosespasien->getNama($i);
                    $nik = $this->prosespasien->getNik($i);
                    $tempat = $this->prosespasien->getTempat($i);
                    $tl = $this->prosespasien->getTl($i);
                    $gender = $this->prosespasien->getGender($i);
                    $email = $this->prosespasien->getEmail($i);
                    $telp = $this->prosespasien->getTelp($i);
                    break;
                }
            }
        }
        $this->tpl = new Template("templates/form.html");

        $this->tpl->replace("AKSI", "update.php");
        $this->tpl->replace("ID_SEMBUNYI", "<input type='hidden' name='id' value='$id'");
        $this->tpl->replace("NIK", $nik);
        $this->tpl->replace("NAMA", $nama);
        $this->tpl->replace("TEMPAT", $tempat);
        $this->tpl->replace("TL", $tl);
        $this->tpl->replace("EMAIL", $email);
        $this->tpl->replace("TELP", $telp);
        if(strcasecmp($gender, "Laki-laki") == 0){
            $this->tpl->replace(
                'RADIO',
                '
                <label for="laki-laki">laki-laki</label>
                <input class=" custom-radio" name="gender" value="Laki-laki" type="radio" checked >
                <label for="perempuan">perempuan</label>
                <input class=" custom-radio" name="gender" value="Perempuan" type="radio">
                '
            );
        }
        else{
            $this->tpl->replace(
                'RADIO',
                '
                <label for="laki-laki">laki-laki</label>
                <input class=" custom-radio" name="gender" value="Laki-laki" type="radio">
                <label for="perempuan">perempuan</label>
                <input class=" custom-radio" name="gender" value="Perempuan" type="radio" checked>
                '
            );
        }
            
        if(isset($id) && !empty($id)){
            $this->tpl->replace("METODE_CRUD", 'up');
        }
        else{
            $this->tpl->replace("METODE_CRUD", 'insert');
        }
        $this->tpl->write();

    }
}