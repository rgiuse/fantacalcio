<h1>{L_PC_TITLE}</h1> 

<p>{L_PC_EXPLAIN}</p>

<form action="{S_USER_ACTION}" method="post">
	<table width="100%" cellspacing="1" cellpadding="4" border="0" class="forumline">
		<tr>
			<th class="thHead">{L_EDIT_PC}</th>
		</tr>
		<tr>
			<td class="row1">{L_POST_COUNT}</td>
			<td class="row2"><input type="text" class="post" name="posts" maxlength="50" size="20" value="{POSTS}" /></td>
		</tr>
		<tr>
			<td colspan="2" class="catBottom" align="center">
				{S_HIDDEN_FIELDS}<input type="submit" name="update" value="{L_UPDATE}" class="mainoption" />&nbsp;&nbsp;<input type="reset" name="reset" value="{L_RESET}" class="liteoption" />
			</td>
		</tr>
	</table>
</form>
