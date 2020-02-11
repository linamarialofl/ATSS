<?php
if (isset($_POST['submit_signup']))
{
	require 'dhb.php';


	$apellido = $_POST['lastName_signup'];
	$nombre = $_POST['name_signup'];
	$correo = $_POST['email_signup'];
	$contra = $_POST['pwd_signup'];
	$admin = 'admin';
	$cliente = 'cliente';


	if(empty($apellido) || empty($nombre) || empty($correo) || empty($contra))
	{
		header("Location: register.php?error=emptyFields&apell=".$apellido. "&name=".$nombre."&mail=".$correo);
		exit();
	}
	elseif (!filter_var($correo,FILTER_VALIDATE_EMAIL)) 
	{
		header("Location: register.php?error=invalidEmail&apell=".$apellido. "&name=".$nombre);
		exit();
	}
	elseif (!preg_match("/^[a-zA-Z]/", $nombre)) 
	{
		header("Location: register.php?error=invalidName&apell=".$apellido. "&mail=".$correo);
		exit();
	}

	else
	{
		$sql = "SELECT mail_usuario FROM usuario WHERE mail_usuario=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) 
		{
			header("Location: register.php?error=SQLError");
		    exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"s",$correo);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0)
			{
				header("Location: register.php?error=EmailTaken&apell=".$apellido. "&name=".$nombre."&mail=".$correo);
		    exit();
			}
			else
			{
				$sql = "INSERT INTO usuario (nom_usuario,apel_usuario,mail_usuario,contra_usuario, rol_usuario) VALUES (?,?,?,?,?)";

				$stmt = mysqli_stmt_init($conn);
		        if (!mysqli_stmt_prepare($stmt,$sql)) 
		        {
			        header("Location: register.php?error=SQLError");
		            exit();
		        }
		        else
		        {
		        	$hashedPwd = password_hash($contra, PASSWORD_DEFAULT);
		        	if($nombre == 'Santiago')
		        	{
		        		mysqli_stmt_bind_param($stmt,"sssss",$nombre,$apellido,$correo,$hashedPwd,$admin);
		        	}
		        	else
		        	{
		        		mysqli_stmt_bind_param($stmt,"sssss",$nombre,$apellido,$correo,$hashedPwd,$cliente);
		        	}
		        	
			        mysqli_stmt_execute($stmt);
			        header("Location: register.php?Singup=Success");
		            exit();
		        }
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else
{
    header("Location: register.php");
    exit();
}