<?
if ($index->mib!="mib") die ("Access denied");
echo "<center><font class=\"nadpis\">Zmena hesla</font></center><br><br>";
echo "<script language=javascript>";
echo "<!--\n";
echo "function validate(formular) {\n";
echo "if (zmen.passw.value==\"\") {\n";
echo "alert (\"Zadajte vaše heslo!\");\n";
echo "return false;\n";
echo "} else if (zmen.passw.value!=formular.potpassw.value) {\n";
echo "alert (\"Heslá sa nezhodujú!\");\n";
echo "return false;\n";
echo "} else return true;\n";
echo "}\n";
echo "-->\n";
echo "</script>";
if ($sendpas=="ano") {
$sss=mysql_fetch_array(mysql_query("SELECT heslo FROM mib_alluser WHERE id='$h->id'",$spojenie));
if ($sss[0]!=md5($oldpass)) { echo "<center><b>Staré heslo ste nezadali správne!</b></center>"; }
elseif (strlen($passw)<5) { echo "<center><b>Heslo nesmie byť kratšie ako 5 znakov!</b></center>"; }
elseif ($passw!=$potpassw) { echo "<center><b>Heslá sa nezhodujú!</b></center>"; }
else {
mysql_query("UPDATE mib_alluser SET heslo='".md5($passw)."' WHERE id='$h->id'",$spojenie);
echo "<center><b>Heslo bolo úspešne zmenené.</b></center><br>";
}}
echo "<table align=\"center\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<form onsubmit=\"return validate(this)\" name=\"zmen\" method=\"post\"><input type=\"hidden\" name=\"sendpas\" value=\"ano\">";
echo "<tr><td class=\"podc\" width=\"280\">Staré heslo:</td><td width=\"220\"><input type=\"password\" name=\"oldpass\"></td></tr>";
echo "<tr><td class=\"podc\">Nové heslo:</td><td><input type=\"password\" name=\"passw\"></td></tr>";
echo "<tr><td class=\"podc\">Potvrdiť nové heslo:</td><td><input type=\"password\" name=\"potpassw\"></td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"  OK  \"></td></tr>";
echo "</table>";
?>