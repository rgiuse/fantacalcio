<?
/***************************************************************************
 *                            mod_table_inst.php
 *                            -------------------
 *   begin                : Sunday, Jan 13, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: mod_table_inst.php,v 1.7 2003/02/05 21:45:30 acydburn Exp $
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

define('IN_PHPBB', true);

$phpbb_root_path = './';
include($phpbb_root_path.'extension.inc');
include($phpbb_root_path.'common.'.$phpEx);	
	
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

if ( (!isset($dbms)) || ($dbms == 'oracle') || ($dbms == 'msaccess') )
{
	message_die(GENERAL_ERROR, "This Mod does not support Oracle and MsAccess Databases.");
}

include($phpbb_root_path.'includes/db.'.$phpEx);

//
// Run a complete SQL-Statement, this could be an array
//
function evaluate_statement($sql_query, $hide = FALSE, $replace = FALSE)
{
	global $table_prefix, $remove_remarks, $delimiter, $db;
	
	$errored = FALSE;
	if ($replace)
	{
		$sql_query = preg_replace('/phpbb_/', $table_prefix, $sql_query);
	}

	$sql_query = $remove_remarks($sql_query);
	$sql_query = split_sql_file($sql_query, $delimiter);

	$sql_count = count($sql_query);

	for($i = 0; $i < $sql_count; $i++)
	{
		if (!$hide)
		{
			echo "Running :: " . $sql_query[$i];
		}
		flush();

		if ( !($result = $db->sql_query($sql_query[$i])) )
		{
			$errored = true;
			$error = $db->sql_error();
			if (!$hide)
			{
				echo " -> <b>FAILED</b> ---> <u>" . $error['message'] . "</u><br /><br />\n\n";
			}
		}
		else
		{
			if (!$hide)
			{
				echo " -> <b><span class=\"ok\">COMPLETED</span></b><br /><br />\n\n";
			}
		}
	}

	if ($errored)
	{
		return (FALSE);
	}
	else
	{
		return $result;
	}
}

function fill_new_table_data($dbms)
{
	
	$data = '';

	if ( ($dbms == 'mysql') || ($dbms == 'mysql4') )
	{
		$data = '
CREATE TABLE phpbb_stats_config (
  config_name varchar(50) NOT NULL default \'\',
  config_value varchar(255) NOT NULL default \'\',
  PRIMARY KEY (config_name)
);

CREATE TABLE phpbb_stats_modules (
  module_id tinyint(8) NOT NULL default \'0\',
  name varchar(150) NOT NULL default \'\',
  active tinyint(1) NOT NULL default \'0\',
  installed tinyint(1) NOT NULL default \'0\',
  display_order mediumint(8) unsigned NOT NULL default \'0\',
  update_time mediumint(8) unsigned NOT NULL default \'0\',
  auth_value tinyint(2) NOT NULL default \'0\',
  module_info_cache blob,
  module_db_cache blob,
  module_result_cache blob,
  module_info_time int(10) unsigned NOT NULL default \'0\',
  module_cache_time int(10) unsigned NOT NULL default \'0\',
  PRIMARY KEY (module_id)
);

INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'install_date\', \'' . time() . '\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'return_limit\', \'10\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'version\', \'2.1.5\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'modules_dir\', \'stat_modules\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'page_views\', \'0\');
';
	}
	else if ( ($dbms == 'mssql') || ($dbms == 'mssql-odbc') )
	{
		$data = '
BEGIN TRANSACTION
GO

CREATE TABLE [phpbb_stats_config] (
	[config_name] [varchar] (50) NOT NULL ,
	[config_value] [varchar] (50) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_stats_config] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_stats_config] PRIMARY KEY CLUSTERED 
	(
		[config_name]
	)  ON [PRIMARY] 
GO

CREATE TABLE [phpbb_stats_modules] (
	[module_id] [int] NOT NULL ,
	[name] [char] (150) NOT NULL ,
	[active] [int] NOT NULL,
	[installed] [int] NOT NULL,
	[display_order] [int] NOT NULL,
	[update_time] [int] NOT NULL,
	[auth_value] [int] NOT NULL,
	[module_info_cache] [text],
	[module_db_cache] [text],
	[module_result_cache] [text],
	[module_info_time] [int] NOT NULL,
	[module_cache_time] [int] NOT NULL
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_stats_modules] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_stats_modules] PRIMARY KEY  CLUSTERED 
	(
		[module_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_stats_modules] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_stats_modules_module_id] DEFAULT (0) FOR [module_id],
	CONSTRAINT [DF_phpbb_stats_modules_active] DEFAULT (0) FOR [active],
	CONSTRAINT [DF_phpbb_stats_modules_installed] DEFAULT (0) FOR [installed],
	CONSTRAINT [DF_phpbb_stats_modules_display_order] DEFAULT (0) FOR [display_order],
	CONSTRAINT [DF_phpbb_stats_modules_update_time] DEFAULT (0) FOR [update_time],
	CONSTRAINT [DF_phpbb_stats_modules_auth_value] DEFAULT (0) FOR [auth_value],
	CONSTRAINT [DF_phpbb_stats_modules_module_info_time] DEFAULT (0) FOR [module_info_time],
	CONSTRAINT [DF_phpbb_stats_modules_module_cache_time] DEFAULT (0) FOR [module_cache_time]
GO

INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'install_date\', \'' . time() . '\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'return_limit\', \'10\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'version\', \'2.1.5\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'modules_dir\', \'stat_modules\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'page_views\', \'0\');

COMMIT
GO
	';
	}
	else if ($dbms == 'postgres')
	{
		$data = '
CREATE TABLE phpbb_stats_config (
   config_name varchar(50) NOT NULL,
   config_value varchar(50) NOT NULL,
   CONSTRAINT phpbb_attachments_config_pkey PRIMARY KEY (config_name)
);

CREATE TABLE phpbb_stats_modules (
  module_id int4 NOT NULL DEFAULT 0,
  name varchar(150) NOT NULL default \'\',
  active int2 NOT NULL default 0,
  installed int2 NOT NULL default 0,
  display_order int4 NOT NULL default 0,
  update_time int4 NOT NULL default 0,
  auth_value int2 NOT NULL default 0,
  module_info_cache text,
  module_db_cache text,
  module_result_cache text,
  module_info_time int4 NOT NULL default 0,
  module_cache_time int4 NOT NULL default 0,
  CONSTRAINT phpbb_stats_modules_pkey PRIMARY KEY (module_id)
);

INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'install_date\', \'' . time() . '\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'return_limit\', \'10\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'version\', \'2.1.5\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'modules_dir\', \'stat_modules\');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES (\'page_views\', \'0\');
';
	}

	return $data;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;">
<meta http-equiv="Content-Style-Type" content="text/css">
<style type="text/css">
<!--

font,th,td,p,body { font-family: "Courier New", courier; font-size: 11pt }

a:link,a:active,a:visited { color : #006699; }
a:hover		{ text-decoration: underline; color : #DD6900;}

hr	{ height: 0px; border: solid #D1D7DC 0px; border-top-width: 1px;}

.maintitle,h1,h2	{font-weight: bold; font-size: 22px; font-family: "Trebuchet MS",Verdana, Arial, Helvetica, sans-serif; text-decoration: none; line-height : 120%; color : #000000;}

.ok {color:green}

/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url("templates/subSilver/formIE.css"); 
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#006699" vlink="#5584AA">

<table width="100%" border="0" cellspacing="0" cellpadding="10" align="center"> 
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><img src="templates/subSilver/images/logo_phpBB.gif" border="0" alt="Forum Home" vspace="1" /></td>
				<td align="center" width="100%" valign="middle"><span class="maintitle">Installing Statistics Mod Version 2.1.5</span></td>
			</tr>
		</table></td>
	</tr>
</table>

<br clear="all" />

<?

//
// Here we go
//
include($phpbb_root_path.'includes/sql_parse.'.$phpEx);

$available_dbms = array(
	"mysql" => array(
		"DELIM" => ";",
		"DELIM_BASIC" => ";",
		"COMMENTS" => "remove_remarks"
	), 
	"mysql4" => array(
		"DELIM" => ";", 
		"DELIM_BASIC" => ";",
		"COMMENTS" => "remove_remarks"
	),
	"mssql" => array(
		"DELIM" => "GO", 
		"DELIM_BASIC" => ";",
		"COMMENTS" => "remove_comments"
	),
	"mssql-odbc" =>	array(
		"DELIM" => "GO",
		"DELIM_BASIC" => ";",
		"COMMENTS" => "remove_comments"
	),
	"postgres" => array(
		"LABEL" => "PostgreSQL 7.x",
		"DELIM" => ";", 
		"DELIM_BASIC" => ";",
		"COMMENTS" => "remove_comments"
	)
);

$remove_remarks = $available_dbms[$dbms]['COMMENTS'];;
$delimiter = $available_dbms[$dbms]['DELIM']; 
$delimiter_basic = $available_dbms[$dbms]['DELIM_BASIC']; 

$sql_query = fill_new_table_data($dbms);

$result = evaluate_statement($sql_query, false, true);

$message = '';

if ( !$result )
{
	$message .= "<br />Some queries failed. Please contact me via email, pm, at the board or whatever, so we can solve your problems...<br />";
}
else
{
	$message .= "<br />Statistics Mod Tables generated successfully.";
}

echo "\n<br />\n<b>COMPLETE! Go to the Administration Panel and Install Modules. You have to install and activate Modules before you are able to see anything within the statistics page.</b><br />\n";
echo $message . "<br />";
echo "<br /><b>NOW DELETE THIS FILE</b><br />\n";
echo "</body>";
echo "</html>";

?>