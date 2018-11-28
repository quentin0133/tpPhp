<?php
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];
		return $date;
	}

	function addJours($date, $nbJours){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.(intval($membres[0])+$nbJours);
		return $date;
	}

	function getFrenchDate($date) {
		$membres = explode('-', $date);
		return $membres[2].'/'.$membres[1].'/'.$membres[0];
	}

	function divideFloat($a, $b) {
		$precision = 1;
    $a*=pow(10, $precision);
    $result=(int)($a / $b);
    if (strlen($result)==$precision) return '0.' . $result;
    else return preg_replace('/(\d{' . $precision . '})$/', '.\1', $result);
<<<<<<< HEAD
}

=======
	}

	function isEmptyPersonne($array) {
		return (empty($_POST['per_nom']) || empty($_POST['per_prenom']) || empty($_POST['per_tel'])
		|| empty($_POST['per_mail']) || empty($_POST['per_login'])  || empty($_POST['per_pwd'])
		|| empty($_POST['typePersonne']))
	}
>>>>>>> master
?>
