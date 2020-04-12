<?
if ($index->mib!="mib") die ("Access denied");
echo "<center><font class=\"nadpis\">Session</font><br><br>";
if (!$page) $page=1;
if ($delete=="ok") {
if ($dok!="ok") { echo "Naozaj chcete zrušiť session so sessid $co?<br><a href=\"index.php?action=sess&delete=ok&co=$co&dok=ok&page=$page\">Áno</a> | <a href=\"index.php?action=sess&page=$page\">Nie</a><br><br>"; }
elseif ($dok=="ok") {
mysql_query("DELETE FROM mib_sess WHERE sessid='$co'",$spojenie);
echo "Session $co bolo zrušené.<br><br>";
}
}
$prikaz="SELECT * FROM mib_sess ORDER BY id DESC LIMIT ".($page-1)*"50".","."50";
$vysledok=mysql_query($prikaz,$spojenie);
echo "<table width=\"95%\"><tr><td>Dátum</td><td>Agent</td><td>IP</td><td>Možnosti</td></tr>";
while($zaznam=mysql_fetch_array($vysledok)) {
$ag=mysql_fetch_array(mysql_query("SELECT nick FROM mib_alluser WHERE id='$zaznam[userid]'",$spojenie));
if (!$ag) { $ag="visit"; }
elseif ($ag) { $ag="Agent $ag[0]"; }
echo "<tr><td>".generate_date($zaznam[id],"sec")."</td><td><b>$ag</b></td><td>$zaznam[ip]</td><td><a href=\"index.php?action=sess&delete=ok&co=$zaznam[sessid]&page=$page\">Zrušiť</a></td></tr>";
}
echo "</table>";
$total=mysql_fetch_array(mysql_query("SELECT count(id) FROM mib_sess",$spojenie));
echo "<br><hr>Strana: ";
for ($i=0;$i<$total[0];$i=$i+50) {
 $ppage++;
 if ($ppage==$page) { $exit="<b>".($i/50+1)."</b>&nbsp;"; }
 if ($ppage!=$page) { $exit="<b><a href=\"index.php?action=sess&page=".($i/50+1)."\">".($i/50+1)."</a></b>&nbsp;"; }
 echo $exit;
}
?>