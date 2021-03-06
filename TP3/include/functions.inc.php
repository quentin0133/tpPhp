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
    if(strlen($result)==$precision) {
			return '0.' . $result;
		}
    else {
			return preg_replace('/(\d{' . $precision . '})$/', '.\1', $result);
		}
	}

	function estNumeroTel($numTel) {
		return strlen($numTel) == 10;
	}

	function estEmail($email) {
		$listePersonne = $managerPersonne->getList();
		$estUnique = true;
		foreach ($listePersonne as $personne) {
			if($personne->getMail() == $email) {
				$estUnique = false;
			}
		}
		return filter_var($email, FILTER_VALIDATE_EMAIL) && $estUnique;
	}

	function estLogin($login) {
		$listePersonne = $managerPersonne->getList();
		$estUnique = true;
		foreach ($listePersonne as $personne) {
			if($personne->getLogin() == $login) {
				$estUnique = false;
			}
		}
		return $estUnique;
	}

	function estMDP($password) {
		return strlen($password) < 3;
	}
?>
