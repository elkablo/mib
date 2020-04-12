<?
if ($index->mib!="mib") die ("Access denied");
echo "<script language=javascript>\n";
echo "<!--\n";
echo "var popUpWin = 0;";
echo "function pridat() {\n";
echo "if (popUpWin && !popUpWin.closed) popUpWin.close();\n";
echo "popUpWin = window.open(\"pridatclena.php\",\"AB\",\"scrollbars=yes,status=no,width=395,height=300,menubar=no,resizable=no,directories=no\");\n";
echo "}\n";
echo "-->\n";
echo "</script>\n";
echo "<center><font class=\"nadpis\">Zoznam agentov</font><br><br>";
if (!$page) $page=1;
if ($act=="delete") {
$idudaj=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id=$id",$spojenie));
if ($del!="ok") {
echo "Naozaj chcete zmazať Agenta $idudaj[nick]?<br><a href=\"index.php?action=clen&act=delete&del=ok&id=$id\">Áno</a> | <a href=\"index.php?action=clen\">Nie</a><br><br>";
} elseif ($del=="ok") {
mysql_query("DELETE FROM mib_alluser WHERE id='$id'",$spojenie);
echo "Agent $idudaj[nick] bol zmazaný.<br><br>";
}}
if ($act=="uprav") {
$idudaj=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id=$id",$spojenie));
if ($uprav!="ok") {
echo "<form method=\"post\"><input type=\"hidden\" name=\"uprav\" value=\"ok\"><input type=\"hidden\" name=\"id\" value=\"$id\">";
echo "Meno: <input type=\"text\" name=\"cname\" value=\"$idudaj[name]\"><br>";
echo "Priezvisko: <input type=\"text\" name=\"csurname\" value=\"$idudaj[surname]\"><br>";
echo "Rodné číslo: <input type=\"text\" name=\"crc\" value=\"$idudaj[rc]\"><br>";
if ($idudaj[type]=="mib") { $chm=" SELECTED"; }
if ($idudaj[type]=="admin") { $cha=" SELECTED"; }
echo "Typ: <select name=\"ctype\"><option value=\"mib\"$chm>MiB</option><option value=\"admin\"$cha>Administrátor</option></select><br>";
echo "<input type=\"submit\" value=\"  OK  \"></form><br><br>";
} elseif ($uprav=="ok") {
mysql_query("UPDATE mib_alluser SET name='$cname', surname='$csurname', rc='$crc', type='$ctype' WHERE id='$id'",$spojenie);
echo "Agent $idudaj[nick] bol upravený.<br><br>";
}}
if ($act=="viac") {
$asa=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id=$id",$spojenie));
echo "<table border=\"0\">";
echo "<tr><td>ID:</td><td>$asa[id]</td></tr>";
echo "<tr><td>Nick:</td><td>Agent <b>$asa[nick]</b></td></tr>";
echo "<tr><td>Meno:</td><td>$asa[name]</td></tr>";
echo "<tr><td>Priezvisko:</td><td>$asa[surname]</td></tr>";
echo "<tr><td>Rodné číslo:</td><td>$asa[rc]</td></tr>";
echo "<tr><td>E-mail:</td><td>$asa[mail]</td></tr>";
echo "<tr><td>Telefónne číslo:</td><td>$asa[telc]</td></tr>";
echo "<tr><td>Posledné session:</td><td>".generate_date($asa[lastsession],"sec")."</td></tr>";
echo "</table><br><br>";
}
$vysledok=mysql_query("SELECT * FROM mib_alluser ORDER BY id ASC",$spojenie);
echo "<table border=\"1\" width=\"100%\">";
echo "<tr><td>Nick</td><td>E-mail</td><td>Posledné session</td><td>Stav</td><td>&nbsp;</td></tr>";
while ($zaznam=mysql_fetch_array($vysledok)) {
$ass=mysql_fetch_array(mysql_query("SELECT * FROM mib_sess WHERE userid='$zaznam[id]'",$spojenie));
if ($ass) { $line="<font style=\"color: #00ff00; font-weight: bold\">Online</font>"; }
else { $line="<font style=\"color: #ff0000; font-weight: bold\">Offline</font>"; }
echo "<tr><td><b>Agent $zaznam[nick]</b></td><td><font title=\"Telefón: $zaznam[telc]\">$zaznam[mail]</font></td><td>".generate_date($zaznam[lastsession],false,"xx.xx.xxxx")."</td><td>$line</td><td><a href=\"index.php?action=clen&act=viac&id=$zaznam[id]&page=$page\">V</a> | <a href=\"index.php?action=clen&act=uprav&id=$zaznam[id]&page=$page\">E</a> | <a href=\"index.php?action=clen&act=delete&id=$zaznam[id]&page=$page\">D</a></td></tr>";
}
echo "</table>";
$total=mysql_fetch_array(mysql_query("SELECT count(id) FROM mib_alluser",$spojenie));
echo "<br><hr>Strana: ";
for ($i=0;$i<$total[0];$i=$i+50) {
 $ppage++;
 if ($ppage==$page) { $exit="<b>".($i/50+1)."</b>&nbsp;"; }
 if ($ppage!=$page) { $exit="<b><a href=\"index.php?action=clen&page=".($i/50+1)."\">".($i/50+1)."</a></b>&nbsp;"; }
 echo $exit;
}
echo "<br><br><a href=\"javascript:pridat()\">Pridať Agenta</a></center>";
?>