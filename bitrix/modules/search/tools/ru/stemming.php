<?php
global $STEMMING_RU_VOWELS;
$STEMMING_RU_VOWELS = "���������";
global $STEMMING_RU_PERFECTIVE_GERUND;
$STEMMING_RU_PERFECTIVE_GERUND = "/(������|������|������|������|����|����|����|����|��|��|��|��)$/".BX_UTF_PCRE_MODIFIER;
global $STEMMING_RU_REFLEXIVE;
$STEMMING_RU_REFLEXIVE=array("��", "��");
global $STEMMING_RU_ADJECTIVE;
$STEMMING_RU_ADJECTIVE=array("��", "��", "��", "��", "���", "���", "��", "��", "��", "��", "��", "��", "��", "��", "���", "���", "���", "���", "��", "��", "��", "��", "��", "��", "��", "��");
global $STEMMING_RU_PARTICIPLE_GR1;
$STEMMING_RU_PARTICIPLE_GR1=array("��", "��", "��", "��", "�");
global $STEMMING_RU_PARTICIPLE_GR2;
$STEMMING_RU_PARTICIPLE_GR2=array("���", "���", "���");
global $STEMMING_RU_ADJECTIVAL_GR1;
global $STEMMING_RU_ADJECTIVAL_GR2;
foreach($STEMMING_RU_ADJECTIVE as $i)
{
	foreach($STEMMING_RU_PARTICIPLE_GR1 as $j) $STEMMING_RU_ADJECTIVAL_GR1[]=$j.$i;
	foreach($STEMMING_RU_PARTICIPLE_GR2 as $j) $STEMMING_RU_ADJECTIVAL_GR2[]=$j.$i;
}
global $STEMMING_RU_ADJECTIVAL1;
usort($STEMMING_RU_ADJECTIVAL_GR1, "stemming_ru_sort");
$STEMMING_RU_ADJECTIVAL1="/([��])(".implode("|", $STEMMING_RU_ADJECTIVAL_GR1).")$/".BX_UTF_PCRE_MODIFIER;

global $STEMMING_RU_ADJECTIVAL2;
foreach($STEMMING_RU_ADJECTIVE as $i)
	$STEMMING_RU_ADJECTIVAL_GR2[]=$i;
usort($STEMMING_RU_ADJECTIVAL_GR2, "stemming_ru_sort");
$STEMMING_RU_ADJECTIVAL2="/(".implode("|", $STEMMING_RU_ADJECTIVAL_GR2).")$/".BX_UTF_PCRE_MODIFIER;

global $STEMMING_RU_VERB1;
$STEMMING_RU_VERB1="/([��])(���|���|���|���|��|��|��|��|��|��|��|��|��|��|�|�|�)$/".BX_UTF_PCRE_MODIFIER;

global $STEMMING_RU_VERB_GR2;
$STEMMING_RU_VERB_GR2=array("���", "���", "���", "����", "����", "���", "���", "���", "��", "��", "��", "��", "��", "��", "��", "���", "���", "���", "��", "���", "���", "��", "��", "���", "���", "���", "���", "��", "�");
usort($STEMMING_RU_VERB_GR2, "stemming_ru_sort");
global $STEMMING_RU_VERB2;
$STEMMING_RU_VERB2="/(".implode("|", $STEMMING_RU_VERB_GR2).")$/".BX_UTF_PCRE_MODIFIER;
global $STEMMING_RU_NOUN;
$STEMMING_RU_NOUN="/(����|���|���|���|���|���|��|��|��|��|��|��|��|��|��|��|��|��|��|���|��|��|��|��|��|��|�|�|�|�|�|�|�|�|�|�)$/".BX_UTF_PCRE_MODIFIER;
function stemming_letter_ru()
{
	return "������������������������������������������������������������������";
}
function stemming_ru_sort($a, $b)
{
	$al = strlen($a);
	$bl = strlen($b);
	if($al == $bl)
		return 0;
	elseif($al < $bl)
		return 1;
	else
		return -1;
}
function stemming_stop_ru($sWord)
{
	if(strlen($sWord) < 2)
		return false;
	static $stop_list = false;
	if(!$stop_list)
	{
		$stop_list = array (
			"QUOTE"=>0,"HTTP"=>0,"WWW"=>0,"RU"=>0,"IMG"=>0,"GIF"=>0,"���"=>0,"��"=>0,"���"=>0,
			"���"=>0,"���"=>0,"���"=>0,"��"=>0,"���"=>0,"���"=>0,"��"=>0,"���"=>0,"��"=>0,
			"���"=>0,"���"=>0,"��"=>0,"��"=>0,"���"=>0,"���"=>0,"��"=>0,"��"=>0,"��"=>0,
			"��"=>0,"��"=>0,"��"=>0,"��"=>0,"���"=>0,"����"=>0,"���"=>0,"��"=>0,"���"=>0,
			"���"=>0,"���"=>0,"��"=>0,"��"=>0,"��"=>0,"���"=>0,"��"=>0,"���"=>0,"��"=>0,
			"��"=>0,"��"=>0,"��"=>0,"��"=>0,"��"=>0,"����"=>0,"��"=>0,"���"=>0,"���"=>0,
			"���"=>0,"���"=>0,"���"=>0,"���"=>0,"���"=>0,"���"=>0,"���"=>0,"��"=>0,"���"=>0,
			"�����"=>0,"���"=>0,"��"=>0,"��"=>0,"���"=>0,"���"=>0,"���"=>0,"���"=>0,"����"=>0,
			"��"=>0,"����"=>0,
		);
		if(defined("STEMMING_STOP_RU"))
		{
			foreach(explode(",", STEMMING_STOP_RU) as $word)
			{
				$word = trim($word);
				if(strlen($word)>0)
					$stop_list[$word]=0;
			}
		}
	}
	return !array_key_exists($sWord, $stop_list);
}
function stemming_ru($word)
{
	global $STEMMING_RU_VOWELS;
	global $STEMMING_RU_PERFECTIVE_GERUND;
	global $STEMMING_RU_REFLEXIVE;
	global $STEMMING_RU_ADJECTIVE;
	global $STEMMING_RU_PARTICIPLE_GR2;
	global $STEMMING_RU_ADJECTIVAL1;
	global $STEMMING_RU_ADJECTIVAL2;
	global $STEMMING_RU_VERB1;
	global $STEMMING_RU_VERB_GR2;
	global $STEMMING_RU_VERB2;
	global $STEMMING_RU_NOUN;
	//There is a 33rd letter, � (?), but it is rarely used, and we assume it is mapped into � (e).
	$word=str_replace("�", "�", $word);
	//Exceptions
	static $STEMMING_RU_EX = array("����"=>true,"����"=>true,"����"=>true,"������"=>true,"������"=>true);
	if(isset($STEMMING_RU_EX[$word]))
		return $word;
	//In any word, RV is the region after the first vowel, or the end of the word if it contains no vowel.
	//All tests take place in the the RV part of the word.
	$found=array();
	if(preg_match("/^(.*?[$STEMMING_RU_VOWELS])(.+)$/".BX_UTF_PCRE_MODIFIER, $word, $found))
	{
		$rv = $found[2];
		$word = $found[1];
	}
	else
	{
		return $word;
	}

	//Do each of steps 1, 2, 3 and 4.
	//Step 1: Search for a PERFECTIVE GERUND ending. If one is found remove it, and that is then the end of step 1.


	if(preg_match($STEMMING_RU_PERFECTIVE_GERUND, $rv, $found))
	{
		switch($found[0]) {
			case "��":
			case "����":
			case "������":
			case "��":
			case "����":
			case "������":
				$rv = substr($rv, 0, 1-strlen($found[0]));
				break;
			default:
				$rv = substr($rv, 0, -strlen($found[0]));
		}
	}
	//Otherwise try and remove a REFLEXIVE ending, and then search in turn for
	// (1) an ADJECTIVE,
	// (2) a VERB or (3)
	// a NOUN ending.
	// As soon as one of the endings (1) to (3) is found remove it, and terminate step 1.
	else
	{
		$rv = preg_replace("/(��|��)$/".BX_UTF_PCRE_MODIFIER, "", $rv);
		//ADJECTIVAL
		if(preg_match($STEMMING_RU_ADJECTIVAL1, $rv, $found))
			$rv = substr($rv, 0, -strlen($found[2]));
		elseif(preg_match($STEMMING_RU_ADJECTIVAL2, $rv, $found))
			$rv = substr($rv, 0, -strlen($found[0]));
		elseif(preg_match($STEMMING_RU_VERB1, $rv, $found))
			$rv = substr($rv, 0, -strlen($found[2]));
		elseif(preg_match($STEMMING_RU_VERB2, $rv, $found))
			$rv = substr($rv, 0, -strlen($found[0]));
		else
			$rv = preg_replace($STEMMING_RU_NOUN, "", $rv);
	}

	//Step 2: If the word ends with � (i), remove it.
	if(substr($rv, -1) == "�")
		$rv = substr($rv, 0, -1);
	//Step 3: Search for a DERIVATIONAL ending in R2 (i.e. the entire ending must lie in R2), and if one is found, remove it.
	//R1 is the region after the first non-vowel following a vowel, or the end of the word if there is no such non-vowel.
	if(preg_match("/(����|���)$/".BX_UTF_PCRE_MODIFIER, $rv))
	{
		$R1=0;
		$rv_len = strlen($rv);
		while( ($R1<$rv_len) && (strpos($STEMMING_RU_VOWELS, substr($rv,$R1,1))!==false) )
			$R1++;
		if($R1 < $rv_len)
			$R1++;
		//R2 is the region after the first non-vowel following a vowel in R1, or the end of the word if there is no such non-vowel.
		$R2 = $R1;
		while( ($R2<$rv_len) && (strpos($STEMMING_RU_VOWELS, substr($rv,$R2,1))===false) )
			$R2++;
		while( ($R2<$rv_len) && (strpos($STEMMING_RU_VOWELS, substr($rv,$R2,1))!==false) )
			$R2++;
		if($R2 < $rv_len)
			$R2++;
		//"����", "���"
		if((substr($rv, -4) == "����") && ($rv_len >= ($R2+4)))
			$rv = substr($rv, 0, $rv_len - 4);
		elseif((substr($rv, -3) == "���") && ($rv_len >= ($R2+3)))
			$rv = substr($rv, 0, $rv_len - 3);
	}
	//Step 4: (1) Undouble � (n), or, (2) if the word ends with a SUPERLATIVE ending, remove it and undouble � (n), or (3) if the word ends � (') (soft sign) remove it.
	$rv = preg_replace("/(����|���)$/".BX_UTF_PCRE_MODIFIER, "", $rv);
	$r = preg_replace("/��$/".BX_UTF_PCRE_MODIFIER, "�", $rv);
	if($r == $rv)
		$rv = preg_replace("/�$/".BX_UTF_PCRE_MODIFIER, "", $rv);
	else
		$rv = $r;

	return $word.$rv;
}
?>
