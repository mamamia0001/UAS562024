<?php 

session_start();


include 'koneksi.php';


$username = $_POST['username'];
$password = $_POST['password'];



$user = mysqli_query($koneksi,"select * from login where username='$username' and password='$password'");

$cek = mysqli_num_rows($user);


if($cek > 0){

	$data = mysqli_fetch_assoc($user);

	
	if($data['level']=="admin"){

		
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		
		header("location:halaman_admin.php");

	
	}else if($data['level']=="customer"){
		
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "customer";
		
		header("location:halaman_user.php");

	
	}else{

		
		header("location:index.php?pesan=gagal");
	}

	
}else{
	header("location:index.php?pesan=gagal");
}



?>