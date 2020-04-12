<?
if ($index->mib!="mib") die ("Access denied");
echo "<center><font class=\"nadpis\">Úlohy agentov</font><br><br>";
if (!$page) $page=1;
if ($zadat=="ok") {
$asa=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id=$cid",$spojenie));
if ($ano!="ok") {
echo "<form method=\"post\"><input type=\"hidden\" name=\"ano\" value=\"ok\"><input type=\"hidden\" name=\"cid\" value=\"$cid\">Agent: <b>$asa[nick]</b>";
echo "<br>Úloha: <textarea cols=\"0\" name=\"uloha\" style=\"width:291; height:58\"></textarea><br><input type=\"submit\" value=\"  OK  \"></form><br><br>";
} elseif ($ano=="ok") {
if ($uloha=="") { echo "Musíte zadať úlohu!<br><br>"; }
else {
mysql_query("DELETE FROM mib_uloha WHERE clenid='$asa[id]'",$spojenie);
mysql_query("INSERT INTO mib_uloha VALUES ('$idtime','$asa[id]','$uloha','$h->id')",$spojenie);
echo "Úloha bola zadaná.<br><br>";
}}}
echo "<hr>";
$prikaz="SELECT * FROM mib_alluser ORDER BY id DESC LIMIT ".($page-1)*"50".","."50";
$vysledok=mysql_query($prikaz,$spojenie);
while ($zaznam=mysql_fetch_array($vysledok)) {
$uloha=mysql_fetch_array(mysql_query("SELECT * FROM mib_uloha WHERE clenid=$zaznam[id]",$spojenie));
$zadal=mysql_fetch_array(mysql_query("SELECT nick FROM mib_alluser WHERE id='$uloha[zadal]'",$spojenie));
echo "<br>Dátum zadania: ".generate_date($uloha[id],false,"xx.xx.xxxx")." (zadal: $zadal[0]) Agent <b>$zaznam[nick]</b>. <a href=\"index.php?action=uloha&zadat=ok&cid=$zaznam[id]&page=$page\">Zadať Agentovi $zaznam[nick] inú úlohu</a><br>$uloha[uloha]<hr>";
}
$total=mysql_fetch_array(mysql_query("SELECT count(id) FROM mib_alluser",$spojenie));
echo "<br>Strana: ";
for ($i=0;$i<$total[0];$i=$i+50) {
 $ppage++;
 if ($ppage==$page) { $exit="<b>".($i/50+1)."</b>&nbsp;"; }
 if ($ppage!=$page) { $exit="<b><a href=\"index.php?action=uloha&page=".($i/50+1)."\">".($i/50+1)."</a></b>&nbsp;"; }
 echo $exit;
}
echo "</center>";
?>