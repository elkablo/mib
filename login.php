<?
if ($index->mib!="mib") die ("Access denied");
echo "<center><font class=\"nadpis\">Login</font></center><br><br>";
echo "<font class=\"text\"><blockquote>&nbsp;&nbsp;&nbsp;Ak tu máte účet, zadajte svoj nick a heslo:</blockquote></font>";
echo "<form method=\"post\"><input type=\"hidden\" name=\"sent\" value=\"ok\"><table align=\"center\" border=\"0\">$loginerror<tr><td>Nick:</td><td><input type=\"text\" name=\"dname\"></td></tr><tr><td>Heslo:</td><td><input type=\"password\" name=\"dpass\"></td></tr><tr><td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"  OK  \"></td></tr></table></form>";
?>