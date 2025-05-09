<?php
/***************************************************************************
*                           lang_statistics.php
* Italian Language File
* Translated by Dueller <dueller@comunicatori.net> in june 2003 and based on the orininal english language file below:
*                            -------------------
*   begin                : Tue February 26 2002
*   copyright            : (C) 2002 Nivisec.com
*   email                : admin@nivisec.com
*
*   $Id: lang_statistics.php,v 1.4 2002/11/09 16:04:08 acydburn Exp $
*
***************************************************************************/
/***************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
***************************************************************************/

// Original Statistics Mod (c) 2002 Nivisec - http://nivisec.com/mods

//
// If you want to credit the Author on the Statistics Page, uncomment the second line.
//
$lang['Version_info'] = '<br />Statistics Mod Versione %s'; //%s = number
//$lang['Version_info'] = '<br />Statistics Mod Versione %s &copy; 2002 <a href="http://www.opentools.de/board">Acyd Burn</a>';

//
// These Language Variables are available for all installed Modules
//
$lang['Rank'] = 'Classifica';
$lang['Percent'] = 'Percentuale';
$lang['Graph'] = 'Grafico';
$lang['Uses'] = 'Usato';
$lang['How_many'] = 'Quanti';

//
// Main Language
//

//
// Page Header/Footer
//
$lang['Install_info'] = 'Installato %s'; //%s = date
$lang['Viewed_info'] = 'Statistiche elaborate %d volte'; //%d = number
$lang['Statistics_title'] = 'Statistiche del Forum';

//
// Admin Language
//
$lang['Statistics_management'] = 'Moduli Statistici';
$lang['Statistics_config'] = 'Configurazione Statistiche';

//
// Statistics Config
//
$lang['Statistics_config_title'] = 'Configurazione Statistiche';

$lang['Return_limit'] = 'Limite Risultati';
$lang['Return_limit_desc'] = 'Il numero di risultati da includere in ogni classifica. Valido per tutti i moduli qui specificati.';
$lang['Clear_cache'] = 'Reimposta la cache dei moduli';
$lang['Clear_cache_desc'] = 'Pulisci tutti i dati memorizzati nella cache di tutti i moduli.';
$lang['Modules_directory'] = 'Directory dei Moduli';
$lang['Modules_directory_desc'] = 'La directory (sottodir. della directory di PHPBB) dove sono localizzati i moduli.  Le barre / o \ non devono essere utilizzate!';

//
// Status Messages
//
$lang['Messages'] = 'Messaggi di Amministrazione';
$lang['Updated'] = 'Aggiornato';
$lang['Active'] = 'Attivo';
$lang['Activate'] = 'Attiva';
$lang['Activated'] = 'Attivato';
$lang['Not_active'] = 'Non Attivo';
$lang['Deactivate'] = 'Disattiva';
$lang['Deactivated'] = 'Disattivato';
$lang['Install'] = 'Installa';
$lang['Installed'] = 'Installato';
$lang['Uninstall'] = 'Disinstalla';
$lang['Uninstalled'] = 'Disinstallato';
$lang['Move_up'] = 'Muovi Su';
$lang['Move_down'] = 'Muovi Gi�';
$lang['Update_time'] = 'Tempo di aggiornamento';
$lang['Auth_settings_updated'] = 'Configurazione Autorizzazioni - [Queste sono sempre aggiornate]';

//
// Modules Management
//
$lang['Back_to_management'] = 'Torna alla configurazione dei moduli';
$lang['Statistics_modules_title'] = 'Configurazione Modulo di Statistica';

$lang['Module_name'] = 'Nome';
$lang['Directory_name'] = 'Nome della Directory';
$lang['Status'] = 'Status';
$lang['Update_time_minutes'] = 'Tempo di Aggiornamento in Minuti';
$lang['Update_time_desc'] = 'Intervallo (in Minuti) per l\'aggiornamento dei dati memorizzati nella cache con i dati nuovi.';
$lang['Auto_set_update_time'] = 'Determina ed imposta i tempi di aggiornamento per ogni modulo installato (ed attivato). Attenzione: pu� essere un\'operazione lunga.';
$lang['Uninstall_module'] = 'Disintalla il modulo';
$lang['Uninstall_module_desc'] = 'Marca il modulo come "non installato", in modo da poterlo reinstallare con il comando di installazione. Non viene cancellato fisicamente, se vuoi devi farlo manualmente dalla directory.';
$lang['Active_desc'] = 'Opzione relativa al modulo installato in modo da visualizzarlo a seconda dei permessi.';
$lang['Go'] = 'Vai';

$lang['Not_allowed_to_install'] = 'Non sei abilitato ad installare questo modulo. Probabilmente perch� non hai installato il Mod necessario per utilizzare questo modulo. Contatta l\'autore del modulo de hai delle domande e se le Extra Info qui presenti non hanno significato per te.';
$lang['Wrong_stats_mod_version'] = 'Non sei abilitato ad installare questo modulo perch� lo Statistics Mod installato non � di una versione compatibile con quella richiesta dal modulo. Per utilizzare il modulo hai bisogno della Versione %s (o superiore) dello Statistics Mod.'; // replace %s with Version (2.1.3 for example)
$lang['Module_install_error'] = 'C\'� stato un qualche errore durante l\installazione di questo modulo. Sembra che alcuni comandi SQL non possono essere eseguiti, controlla i messagi di errore in alto.';

$lang['Preview_debug_info'] = 'Questo Modulo � stato generato in %f secondi: sono state eseguite %d queries.'; // Replace %f with seconds and %d with queries
$lang['Update_time_recommend'] = 'Lo Statistics Mod raccomanda (in relazione alle inormazioni di debug) in tempo di aggiornamento di <b>%d</b> Minuti.'; // Replace %d with Minutes

?>