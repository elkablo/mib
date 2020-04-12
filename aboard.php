<?
if ($index->mib!="mib") die ("Access denied");
if (!$page) { $page="1"; }
echo "<center><font class=\"nadpis\">FÓRUM</font></center><br><br>";
if ($pridat=="ok") {
if ($okk!="ano") { echo "<center>Názov diskusie: <form method=\"post\"><input type=\"hidden\" name=\"okk\" value=\"ano\"><input type=\"text\" name=\"nazov\"><br>Typ: <select name=\"typ\"><option value=\"forall\">forall</option><option value=\"formib\">formib</option></select><br><input type=\"submit\"value=\" POTVRDIŤ \"></form></center>"; }
if ($okk=="ano") {
$exist=mysql_fetch_array(mysql_query ("SELECT * FROM mib_board_name WHERE name LIKE '$nazov'", $spojenie));
if (!$exist) { $exx=false; }
else {
if ($nazov==$exist[name]) { $exx=true; }
else { $exx=false; }
}
if ($nazov=="") { echo "<font color=\"#ff0000\"><center><b>Musíte zadať názov!</b></center></font>"; }
elseif (strlen($nazov)>20) { echo "<font color=\"#ff0000\"><center><b>Názov nesmie byť dlhší ako 20 znakov!</b></center></font>"; }
elseif ($exx) { echo "<font color=\"#ff0000\"><center><b>Takáto téma už existuje!</b></center></font>"; }
else { mysql_query("INSERT INTO mib_board_name VALUES('$idtime','$nazov','$typ')",$spojenie); echo "<center>Téma $nazov bola pridaná!</center>"; }
}}
if ($act=="zmen") {
$xas=mysql_fetch_array(mysql_query("SELECT * FROM mib_board_name WHERE id='$id'",$spojenie));
if ($okk!="ano") { echo "<center><form method=\"post\"><input type=\"hidden\" name=\"okk\" value=\"ano\">Názov diskusie: <input type=\"text\" name=\"nazov\" value=\"$xas[name]\"><br>Typ: <select name=\"typ\">";
if ($xas[type]=="forall") {$chc=" SELECTED";}
elseif ($xas[type]=="formib") {$chb=" SELECTED";}
echo "<option value=\"forall\"$chc>forall</option>";
echo "<option value=\"formib\"$chb>formib</option>";
echo "</select><br><input type=\"submit\"value=\" POTVRDIŤ \"></form></center>"; }
if ($okk=="ano") {
mysql_query("UPDATE mib_board_name SET name='$nazov', type='$typ' WHERE id='$id'",$spojenie); echo "<center>Téma $xas[name] bola zmenená.</center>";
}}
if ($act=="delete") {
$xas=mysql_fetch_array(mysql_query("SELECT * FROM mib_board_name WHERE id='$id'",$spojenie));
if ($okk!="ano") { echo "<center>Naozaj chcete vymazať diskusiu $xas[name]?<br><a href=\"index.php?action=board&act=delete&okk=ano&id=$id&page=$page\">Áno</a> | <a href=\"index.php?action=board&page=$page\">Nie</a></center>"; }
elseif ($okk=="ano") {
mysql_query("DELETE FROM mib_board_name WHERE id='$id'",$spojenie);
mysql_query("DELETE FROM mib_board WHERE boardid='$id'",$spojenie);
echo "<center>Téma $xas[name] bola vymazaná!</center>";
}}
echo "<blockquote><font class=\"text\">";
echo "Výber diskusií:<br><br></blockquote>";
echo "<table align=\"center\" width=\"400\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<tr><td>Názov:</td><td>Príspevkov:</td><td>Založená:</td><td>Typ:</td><td>Možnosti:</td></tr>";
$prikaz="SELECT * FROM mib_board_name ORDER BY id DESC LIMIT ".($page-1)*"20".","."20";
$vysledok=mysql_query($prikaz,$spojenie);
while ($zaznam=mysql_fetch_array($vysledok)) {
$poc=mysql_fetch_array(mysql_query("SELECT count(id) FROM mib_board WHERE boardid='$zaznam[id]'",$spojenie));
$pocc=mysql_fetch_array(mysql_query("SELECT id FROM mib_board WHERE boardid='$zaznam[id]' ORDER BY id DESC LIMIT 1",$spojenie));
if (!$autor[0]) $autor[0]="anonym";
echo "<tr><td><a href=\"index.php?action=openboard&boardid=$zaznam[id]\" title=\"$zaznam[name] - založená: ".generate_date($zaznam[id],"sec")."\">$zaznam[name]</a></td><td><font title=\"Posledný príspevok: ".generate_date($pocc[0],"sec")."\">$poc[0]</font></td><td>".generate_date($zaznam[id],false,"xx.xx.xxxx")."</td><td>$zaznam[type]</td><td><a href=\"index.php?action=board&act=zmen&id=$zaznam[id]&page=$page\">Zmeniť</a> | <a href=\"index.php?action=board&act=delete&id=$zaznam[id]&page=$page\">Zmazať</a></td></tr>";
}
echo "</table><center><br><hr>Strana: ";
$total=mysql_fetch_row(mysql_query("SELECT count(id) FROM mib_board_name",$spojenie));
for ($i=0;$i<$total[0];$i=$i+20) {
 $ppage++;
 if ($ppage==$page) { $exit="<b>".($i/20+1)."</b>&nbsp;"; }
 if ($ppage!=$page) { $exit="<b><a href=\"index.php?action=board&page=".($i/20+1)."\">".($i/20+1)."</a></b>&nbsp;"; }
echo $exit;
 }
echo "<br><a href=\"index.php?action=board&pridat=ok\">Pridať diskusnú tému.</a></center></font>";
?>