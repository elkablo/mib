<?
if ($index->mib!="mib") die ("Access denied");
$asa=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id='$h->id'",$spojenie));
echo "<center><font class=\"nadpis\">Údaje Agenta $asa[nick]</font><br><br>";
if ($udajesent=="ok") {
mysql_query("UPDATE mib_alluser SET mail='$mail', telc='$telc' WHERE id='$h->id'",$spojenie);
echo "Údaje boli zmenené.<br>";
}
echo "<form method=\"post\"><input type=\"hidden\" name=\"udajesent\" value=\"ok\"><table border=\"1\" width=\"80%\">";
echo "<tr height=\"28\"><td>Nick:</td><td>Agent <b>$asa[nick]</b></td></tr>";
echo "<tr height=\"28\"><td>Meno:</td><td>$asa[name]</td></tr>";
echo "<tr height=\"28\"><td>Priezvisko:</td><td>$asa[surname]</td></tr>";
echo "<tr height=\"28\"><td>Rodné číslo:</td><td>$asa[rc]</td></tr>";
echo "<tr height=\"28\"><td>E-mail:</td><td><input type=\"text\" name=\"mail\" value=\"$asa[mail]\" size=\"30\"></td></tr>";
echo "<tr height=\"28\"><td>Telefónne číslo:</td><td><input type=\"text\" name=\"telc\" value=\"$asa[telc]\" size=\"30\"></td></tr>";
echo "<tr height=\"28\"><td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"  OK  \"></td></tr>";
echo "</table></form><br>Ak chcete zmeniť ostatné údaje, kontaktujte toho, čo vám zadáva úlohu.";
echo "</center>";
?>