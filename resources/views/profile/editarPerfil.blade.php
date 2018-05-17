<form id="profileForm" action="editarPerfil.php" method="post" name="profileForm"><br />
<table border="0" width="300" cellspacing="0" cellpadding="2" align="center">
<tbody>
<tr>
<th>Ediar perfil</th>
<td>/&gt;</td>
</tr>
<tr>
<th width="124">Nombre de usuario</th>
<td width="168"><input id="login" class="textfield" name="username" type="text" value="&lt;? echo $SESSION-USER[" />" /&gt;</td>
</tr>
<tr>
<th>Contase&ntilde;a</th>
<td><input id="password" class="textfield" name="password" type="password" value="&lt;? echo $SESSION-USER[" />" /&gt;</td>
</tr>
<tr>
<th>Repite contase&ntilde;a</th>
<td><input id="password2" class="textfield" name="password2" type="password" value="&lt;? echo $SESSION-USER[" />" /&gt;</td>
</tr>
<tr>
<th>Edad</th>
<td><input id="edad" class="textfield" name="edad" type="text" value="&lt;? echo $SESSION-USER[" />"/&gt;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="Submit" type="submit" value="Edit Profile" /></td>
</tr>
</tbody>
</table>
</form>