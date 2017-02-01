<?php  
class Operational{

	public function __construct(){
	$this->db = new PDO('mysql:host=localhost;dbname=t4t_t4t','root','');
	}

	public function addPartisipan($kode, $judul, $pengarang, $penerbit){
		$sql = "INSERT INTO t4t_petani (id_desa, kode_petani, nm_petani, no_ktp, alamat, KEL_TANI, KEANGGOTAAN_KEL, JENIS_KEL, UMUR, profesi, motif, RENCANA_TEBANG, ) VALUES ('$kode', '$judul', '$pengarang', '$penerbit')";
		$query = $this->db->query($sql);
		if(!$query){
		return "Failed";
		}
		else{
		return "Success";
		}
	}

	public function editPartisipan($kode, $id_desa){
	$sql = "SELECT * FROM t4t_petani WHERE kode_petani='$kode' AND id_desa='$id_desa'";
	$query = $this->db->query($sql);
	return $query;
	}

	public function updatePartisipan($kode, $judul, $pengarang, $penerbit){
		$sql = "UPDATE t4t_petani SET judulBuku='$judul', pengarang='$pengarang', penerbit='$penerbit' WHERE kodeBuku='$kode'";
		$query = $this->db->query($sql);
		if(!$query){
		return "Failed";
		}
		else{
		return "Success";
		}
	}
	 
	public function showPartisipan(){
	$sql = "SELECT * FROM t4t_petani limit 4";
	$query = $this->db->query($sql);
	return $query;
	}
	
	public function deletePartisipan($kode, $id_desa){
	$sql = "DELETE FROM t4t_petani WHERE kode_petani='$kode' AND id_desa='$id_desa'";
	$query = $this->db->query($sql);
	}
}



?>