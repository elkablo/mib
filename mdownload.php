<?
if ($index->mib!="mib") die ("Access denied");
echo "<center><font class=\"nadpis\">Download</font><br><br>";
$pr="SELECT * FROM mib_download ORDER BY id DESC";
$vy=mysql_query($pr,$spojenie);
echo "<table width=\"500\" border=\"1\"><tr><td>Názov</td><td>Veľkosť</td><td>&nbsp;</td></tr>";
while($zaznam=mysql_fetch_array($vy)) {
echo "<tr><td>$zaznam[name]</td><td>".binarys($zaznam[size])."</td><td><a href=\"$zaznam[url]\">Download</a></td></tr>";
}
echo "</table></center>";
?>