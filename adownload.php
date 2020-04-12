<?
if ($index->mib!="mib") die ("Access denied");
echo "<center><font class=\"nadpis\">Download</font><br><br>";
if ($act=="add") {
if ($aok!="ok") { echo "<center><form method=\"post\"><input type=\"hidden\" name=\"aok\" value=\"ok\">Názov: <input type=\"text\" name=\"nazov\"><br>Veľkosť: <input type=\"text\" name=\"size\"><br>URL: <input type=\"text\" name=\"url\"><br><input type=\"submit\" value=\" OK \"></form></center>"; }
elseif ($aok=="ok") {
mysql_query("INSERT INTO mib_download VALUES('$idtime','$nazov','$url','$size')",$spojenie);
echo "Údaj bol pridaný.<br>";
}}
if ($act=="update") {
$zzm=mysql_fetch_array(mysql_query("SELECT * FROM mib_download WHERE id='$id'",$spojenie));
if ($zok!="ok") { echo "<center><form method=\"post\"><input type=\"hidden\" name=\"zok\" value=\"ok\"><input type=\"hidden\" name=\"id\" value=\"$zzm[id]\">Názov: <input type=\"text\" name=\"nazov\" value=\"$zzm[name]\"><br>Veľkosť: <input type=\"text\" name=\"size\" value=\"$zzm[size]\"><br>URL: <input type=\"text\" name=\"url\" value=\"$zzm[url]\"><br><input type=\"submit\" value=\" OK \"></form></center>"; }
elseif ($zok=="ok") {
mysql_query("UPDATE mib_download SET name='$nazov', size='$size', url='$url' WHERE id='$id'",$spojenie);
echo "Údaje boli zmenené.<br>";
}}
if ($act=="delete") {
$zzm=mysql_fetch_array(mysql_query("SELECT * FROM mib_download WHERE id='$id'",$spojenie));
if ($okk!="ok") { echo "<center>Naozaj chcete vymazať súbor na stiahnutie - $zzm[name] - z databázy?<br><a class=\"body\" href=\"index.php?action=download&act=delete&okk=ok&id=$zzm[id]\">Áno</a> | <a class=\"body\" href=\"index.php?action=download\">Nie</a></center>"; }
elseif ($okk=="ok") {
mysql_query("DELETE FROM mib_download WHERE id=$id",$spojenie);
echo "Súbor $zzm[name] bol z databázy zmazaný.";
}}
$pr="SELECT * FROM mib_download ORDER BY id DESC";
$vy=mysql_query($pr,$spojenie);
echo "<table width=\"500\" border=\"1\"><tr><td>Názov</td><td>Veľkosť</td><td>Možnosti</td></tr>";
while($zaznam=mysql_fetch_array($vy)) {
echo "<tr><td>$zaznam[name]</td><td>".binarys($zaznam[size])."</td><td><a href=\"index.php?action=download&act=update&id=$zaznam[id]\">Upraviť</a> | <a href=\"index.php?action=download&act=delete&id=$zaznam[id]\">Vymazať</a></td></tr>";
}
echo "</table><br><a href=\"index.php?action=download&act=add\">Pridať súbor na stiahnutie</a></center>";
?>