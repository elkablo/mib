<?
if ($index->mib!="mib") die ("Access denied");
if (!$page) { $page="1"; }
echo "<center><font class=\"nadpis\">FÓRUM</font></center><br><br>";
echo "<blockquote><font class=\"text\">";
echo "Výber diskusií:<br><br></blockquote>";
echo "<table align=\"center\" width=\"400\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<tr><td>Názov:</td><td>Príspevkov:</td><td>Založená:</td></tr>";
$wh=" WHERE type LIKE 'forall' ";
if ($h->ok=="ok") $wh=" WHERE type LIKE 'formib' ";
$prikaz="SELECT * FROM mib_board_name".$wh."ORDER BY id DESC LIMIT ".($page-1)*"20".","."20";
$vysledok=mysql_query($prikaz,$spojenie);
while ($zaznam=mysql_fetch_array($vysledok)) {
$poc=mysql_fetch_array(mysql_query("SELECT count(id) FROM mib_board WHERE boardid='$zaznam[id]'",$spojenie));
$pocc=mysql_fetch_array(mysql_query("SELECT id FROM mib_board WHERE boardid='$zaznam[id]' ORDER BY id DESC LIMIT 1",$spojenie));
if (!$autor[0]) $autor[0]="anonym";
echo "<tr><td><a href=\"index.php?action=openboard&boardid=$zaznam[id]\" title=\"$zaznam[name] - založená: ".generate_date($zaznam[id],"sec")."\">$zaznam[name]</a></td><td><font title=\"Posledný príspevok: ".generate_date($pocc[0],"sec")."\">$poc[0]</font></td><td>".generate_date($zaznam[id],false,"xx.xx.xxxx")."</td></tr>";
}
echo "</table><center><br><hr>Strana: ";
$total=mysql_fetch_row(mysql_query("SELECT count(id) FROM mib_board_name".$wh,$spojenie));
for ($i=0;$i<$total[0];$i=$i+20) {
 $ppage++;
 if ($ppage==$page) { $exit="<b>".($i/20+1)."</b>&nbsp;"; }
 if ($ppage!=$page) { $exit="<b><a href=\"index.php?action=board&page=".($i/20+1)."\">".($i/20+1)."</a></b>&nbsp;"; }
echo $exit;
 }
echo "</center></font>";
?>