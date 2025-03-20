<?php
/***************************************************************************
 *                            admin_postcount.php
 *                            -------------------
 *   begin                : Sunday, July 29th, 2003
 *   copyright            : (C) 2003 Antony Bailey & Freakin' Booty ;-P
 *   email                : santony_bailey@lycos.co.uk
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
define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['Configurazione_Numero_Post'] = $filename;
	
	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include ($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_postcount.'.$phpEx);


if( isset($HTTP_POST_VARS['username']) || isset($HTTP_GET_VARS['username']) )
{
	$username = ( isset($HTTP_POST_VARS['username']) ) ? $HTTP_POST_VARS['username'] : $HTTP_GET_VARS['username'];
	if( !$this_userdata = get_userdata($username) )
	{
		message_die(GENERAL_MESSAGE, $lang['User_not_exist']);
	} 
	$user_id = $this_userdata['user_id'];
	$username = $this_userdata['username'];

	if( $HTTP_POST_VARS['update'] )
	{
		$posts = ( isset($HTTP_POST_VARS['posts']) ) ? intval($HTTP_POST_VARS['posts']) : 0;

		$sql = "UPDATE " . USERS_TABLE . " 
				SET user_posts = '$posts'
				WHERE user_id = $user_id";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Unable to update the database", "Error", __LINE__, __FILE__, $sql);
		}

		$message = $lang['Post_count_changed'] . '<br /><br />' . sprintf($lang['Click_return_posts_config'], '<a href="' . append_sid("admin_postcount.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}


	$s_hidden_fields = '<input type="hidden" name="username" value="' . $username . '" />';

	$template->set_filenames(array(
		'body' => 'admin/postcount_body.tpl'
		)
	);

	$template->assign_vars(array(
		'L_PC_TITLE' => $lang['Modify_post_counts'],
		'L_PC_EXPLAIN' => $lang['Post_count_explain'],
		'L_EDIT_PC' => $lang['Modify post count'],
		'L_POST_COUNT' => sprintf($lang['Edit_pc'], $username),
		'L_UPDATE' => $lang['Update'],
		'L_RESET' => $lang['Reset'],

		'POSTS' => $this_userdata['user_posts'],
		'S_HIDDEN_FIELDS' => $s_hidden_fields,
		'S_USER_ACTION' => append_sid("admin_postcount.$phpEx"),
		'S_USER_SELECT' => $select_list
		)
	);
}
else
{
	$template->set_filenames(array(
		'body' => 'admin/user_select_body.tpl'
		)
	);

	$template->assign_vars(array(
		'L_USER_TITLE' => $lang['Modify_post_counts'],
		'L_USER_EXPLAIN' => $lang['Post_count_explain'],
		'L_USER_SELECT' => $lang['Select_a_User'],
		'L_LOOK_UP' => $lang['Look_up_user'],
		'L_FIND_USERNAME' => $lang['Find_username'],

		'U_SEARCH_USER' => append_sid("./../search.$phpEx?mode=searchuser"), 

		'S_USER_ACTION' => append_sid("admin_postcount.$phpEx"),
		'S_USER_SELECT' => $select_list
		)
	);
}

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
