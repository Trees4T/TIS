<?php 
error_reporting(0);
session_start();

ob_start();
include '../koneksi/koneksi.php';
	date_default_timezone_set('Asia/Jakarta');
	$tanggal=date("Y-m-d h:i:s");
	$kode=$_SESSION['kode'];
	$id_part=$conn->query("select no from t4t_partisipan where id='$kode'")->fetch();
	$code=$_POST['code'];
	$name=$_POST['nama'];
	$address=$_POST['alamat'];
	$city=$_POST['kota'];
	$country=$_POST['negara'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$fax=$_POST['fax'];
	$website=$_POST['web'];
	$contact=$_POST['cp'];
	$director=$_POST['director'];

if ($_POST['code']) {
	if ($_POST['edit']) {
		$id_retailer=$_POST['id_ret'];
		try {	
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->query("UPDATE t4t_retailer set kode_retailer='$code',retailer_name='$name',address='$address',city='$city',country='$country',retailer_email='$email',phone='$phone',fax='$fax',retailer_website='$website',contact_person='$contact',director='$director' where id_retailer='$id_retailer'");
		} catch (PDOException $e) {
			echo $update_error = $e->getMessage();
		}
		

		if ($update_error==false) {
			$_SESSION['success']=1;
			$_SESSION['message']=$name;
			header("location:../dashboard/member.php?0b165156b7fe7272f678e4260adf7ca44b0cdf83696b129b40c49b50b1eb92f4");
		}elseif($update_error==true){
			$_SESSION['success']=2;
			$_SESSION['message']=$update_error;
			header("location:../dashboard/member.php?0b165156b7fe7272f678e4260adf7ca44b0cdf83696b129b40c49b50b1eb92f4");
		}

	}elseif ($_POST['save']) {
		try {	
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->query("INSERT into t4t_retailer 
			(id_retailer,kode_retailer,id_partisipan,retailer_name,address,city,country,phone,fax,contact_person,director,retailer_email,retailer_website,reg_date) values 
			('','$code','$id_part[0]','$name','$address','$city','$country','$phone','$fax','$contact','$director','$email','$website','$tanggal')");
		} catch (PDOException $e) {
			echo $insert_error = $e->getMessage();
		}
		

		if ($insert_error==false) {
			$_SESSION['success']=1;
			header("location:../dashboard/member.php?0b165156b7fe7272f678e4260adf7ca4e715a2c8e845e4ee8b1ca49aeaa84cea");
		}elseif($insert_error==true){
			$_SESSION['success']=2;
			$_SESSION['message']=$insert_error;
			header("location:../dashboard/member.php?0b165156b7fe7272f678e4260adf7ca4e715a2c8e845e4ee8b1ca49aeaa84cea");
		}
	} //end save
	elseif($_POST['delete']){

		$id_retailer=$_POST['id_ret'];
		try {
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->query("DELETE from t4t_retailer where id_retailer='$id_retailer'");
		} catch (PDOException $e) {
			echo $insert_error = $e->getMessage();
		}
		


		if ($insert_error==false) {
			$_SESSION['success']=3;
			$_SESSION['message']=$name;

			header("location:../dashboard/member.php?0b165156b7fe7272f678e4260adf7ca44b0cdf83696b129b40c49b50b1eb92f4");
		}elseif($insert_error==true){
			$_SESSION['success']=4;
			$_SESSION['message']=$insert_error;
			header("location:../dashboard/member.php?0b165156b7fe7272f678e4260adf7ca44b0cdf83696b129b40c49b50b1eb92f4");
		}
	}
}else{
	header("location:../error/403.php");
}
?>