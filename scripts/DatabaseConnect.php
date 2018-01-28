<?php
$config = include 'config.php';

function newRecord($username,$password,$email,$displayName) {
	$config = include 'config.php';
    $conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username,$config->pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, display) VALUES (:username, :password, :email, :display)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
	$stmt->bindParam(':display', $displayName);
    $stmt->execute();
}

function updatepass($user,$pass) {
	$config = include 'config.php';
	$conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username,$config->pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("UPDATE `users` SET `password`= :password WHERE `username` = :username");
	$stmt->bindValue(':username',$user);
	$stmt->bindValue(':password',$pass);
	$stmt->execute();
}

function usernameExists($username) {
	//Checks Whether A Username Exists (Returns 0 or 1 / true or false)
	$config = include 'config.php';
	$conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username,$config->pass);
	$stmt = $conn->prepare('select * from users where `username` = :userx');
	$stmt->bindValue(':userx',$username);
	$stmt->execute();
	$isvalidtest = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if (sizeof($isvalidtest)>0) {
		return true;
	} else {
		return false;
	}
}

function emailExists($email) {
	//Checks Whether An Email Exists (Returns 0 or 1 / true or false)
	$config = include 'config.php';
	$conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username,$config->pass);
	$stmt = $conn->prepare('select * from users where `email` = :emailx');
	$stmt->bindValue(':emailx',$email);
	$stmt->execute();
	$isvalidtest = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if (sizeof($isvalidtest)>0) {
		return true;
	} else {
		return false;
	}
}

function getrelatedinfo($username) {
	//Please  use isusernameinexistance first, then use this.
	//Returns Array With Details
	$config = include 'config.php';
	$conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username,$config->pass);
	$stmt = $conn->prepare('select * from users where `username` = :userx');
	$stmt->bindValue(':userx',$username);
	$stmt->execute();
	return ($stmt->fetchAll(PDO::FETCH_ASSOC));
};

function getrelatedinfoe($email) {
	//Please  use isusernameinexistance first, then use this.
	//Returns Array With Details
	$config = include 'config.php';
	$conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username,$config->pass);
	$stmt = $conn->prepare('select * from users where `email` = :emailx');
	$stmt->bindValue(':emailx',$email);
	$stmt->execute();
	return ($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function splitVar($atestx) {
foreach ($atestx as $row => $g) {
			$pass=$g['password'];
			$ema=$g['email'];
			$usr=$g['username'];
}
return array($pass,$ema,$usr);};
