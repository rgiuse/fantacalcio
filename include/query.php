<?
//necessita di aver inportato function prima di questo
function giocatoriSq($giorn,$sq,$nome_camp,$riserva)
{
	global $db;
	$giornata = sqlcheck($giorn);
	$squadra = sqlcheck($sq);
	$ris = sqlcheck($riserva);
	$ncamp = sqlcheck($nome_camp);
	$idanno=idAnno($ncamp);

	$query = "select datiGiocatori.ID, nome, cognome, ruoli.ruolo from formazioni, datiGiocatori, ruoli where datiGiocatori.id_anno='$idanno' and ruoli.id=datiGiocatori.ruolo and formazioni.squadra = '$squadra' and formazioni.ID=datiGiocatori.ID and formazioni.data_gior='$giornata' and riserva='$ris' and nome_camp='$ncamp'";
	if ($ris==0)
		$query=$query."order by datiGiocatori.ruolo ASC, cognome";
	else 
		$query=$query."order by datiGiocatori.ruolo ASC,id_ins ASC";

	return mysql_query($query,$db);
}

function giocatoriSqRuolo($giorn,$sq,$nome_camp,$rule,$riserva)
{
	global $db;
	$giornata = sqlcheck($giorn);
	$squadra = sqlcheck($sq);
	$ruolo = sqlcheck($rule);
	$ris = sqlcheck($riserva);
	$ncamp = sqlcheck($nome_camp);
	$idanno=idAnno($ncamp);

	$query = "select datiGiocatori.ID, nome, cognome, ruoli.ruolo from formazioni, datiGiocatori, ruoli where datiGiocatori.id_anno='$idanno' and ruoli.id=datiGiocatori.ruolo and ruoli.ruolo='$ruolo' and formazioni.squadra = '$squadra' and formazioni.ID=datiGiocatori.ID and formazioni.data_gior='$giornata' and riserva='$ris' and nome_camp='$ncamp'";
	if ($ris==0)
		$query=$query."order by datiGiocatori.ruolo ASC, cognome";
	else 
		$query=$query."order by datiGiocatori.ruolo ASC,id_ins ASC";

	return mysql_query($query,$db);
}

function giocatoriSqTutti($giorn,$sq,$nome_camp)
{
	global $db;
	$giornata = sqlcheck($giorn);
	$squadra = sqlcheck($sq);
	$ncamp = sqlcheck($nome_camp);
	$idanno=idAnno($ncamp);
	
	$query = "select datiGiocatori.ID, nome, cognome, ruoli.ruolo, riserva from formazioni, datiGiocatori, ruoli where datiGiocatori.id_anno='$idanno' and ruoli.id=datiGiocatori.ruolo and formazioni.squadra = '$squadra' and formazioni.ID=datiGiocatori.ID and formazioni.data_gior='$giornata'and nome_camp='$ncamp' order by datiGiocatori.ruolo ASC, cognome";
	return mysql_query($query,$db);
}

function giocatoriSel_1($sq,$nome_camp)
{
	global $db;
	$squadra = sqlcheck($sq);
	$ncamp = sqlcheck($nome_camp);
	$idanno=idAnno($ncamp);

	$query = "select datiGiocatori.ID, nome, cognome, ruoli.ruolo, ruoli.id, provenienza from datiGiocatori, ruoli, giocatori where datiGiocatori.id_anno='$idanno' and ruoli.id=datiGiocatori.ruolo and datiGiocatori.ID=giocatori.ID and squadra='$squadra' and nome_camp='$ncamp' order by datiGiocatori.ruolo, cognome";

	return mysql_query($query,$db);
}

function giocatoriSel_2($giorn,$sq,$nome_camp)
{
	global $db;
	$giornata = sqlcheck($giorn);
	$squadra = sqlcheck($sq);
	$ncamp = sqlcheck($nome_camp);
	$idanno=idAnno($ncamp);

	$query = "select datiGiocatori.ID from formazioni, datiGiocatori where datiGiocatori.id_anno='$idanno' and formazioni.squadra = '$squadra' and formazioni.ID=datiGiocatori.ID and data_gior='$giornata' and nome_camp='$ncamp' order by ruolo, cognome";

	return mysql_query($query,$db);
}

function utenti($userid)
{
	global $db;
	$query = "select * from utenti where userid ='$userid'";
	return mysql_query($query,$db);
}

function giocatoriTuttiSel_1($tipo,$nome_camp)
{
	global $db;
	$ncamp = sqlcheck($nome_camp);
	$idanno=idAnno($ncamp);

	$query = "select datiGiocatori.ID,cognome,nome,provenienza from datiGiocatori where datiGiocatori.id_anno='$idanno' and ruolo ='$tipo' order by datiGiocatori.cognome";
	return mysql_query($query,$db);
}

function giocatoriTuttiSel_2($tipo,$nome_camp)
{
	global $db;
	$ncamp = sqlcheck($nome_camp);
	$idanno=idAnno($ncamp);

	$query = "select datiGiocatori.ID,cognome,nome,provenienza,squadra from datiGiocatori,giocatori where giocatori.nome_camp='$ncamp' and datiGiocatori.id_anno='$idanno' and ruolo ='$tipo' and datiGiocatori.ID=giocatori.ID order by datiGiocatori.cognome";
	return mysql_query($query,$db);
}

function giocatoriTuttiSel_Sq($tipo,$sq,$nome_camp)
{
	global $db;
	$ncamp = sqlcheck($nome_camp);
	$idanno=idAnno($ncamp);

	$query = "select datiGiocatori.ID,cognome,nome,provenienza,squadra from datiGiocatori,giocatori where giocatori.nome_camp='$ncamp' and datiGiocatori.id_anno='$idanno' and ruolo='$tipo' and datiGiocatori.ID=giocatori.ID and squadra='$sq' order by datiGiocatori.cognome";
	return mysql_query($query,$db);
}

// dal id del roulo mi da il ruolo in formato stringa
function nomeTipo($tipo)
{
	global $db;
	$query = "select ruolo from ruoli where id='$tipo'";
	return mysql_query($query,$db);
}

// dal id della pagina mi da la pagina e il menu laterale in formato stringa
function pagina($id)
{
	global $db;
	$query = "select menu,pagina from pagine where id='$id'";
	return mysql_query($query,$db);
}
// dal id del giocatore e l'id giornata mi da il voto
function votoGiorn($id,$IDgior)
{
	global $db;
	$query = "select voto from voti where ID='$id' and ID_giornata='$IDgior'";
	return mysql_query($query,$db);
}

// dal id del giocatore e l'id giornata mi da il voto
function votoBaseGiorn($id,$IDgior)
{
	global $db;
	$query = "select voto_base from voti where ID='$id' and ID_giornata='$IDgior'";
	return mysql_query($query,$db);
}

?>