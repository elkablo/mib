<?
if ($index->mib!="mib") die ("Access denied");
$asa=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id='$h->id'",$spojenie));
echo "<center><font class=\"nadpis\">Úloha Agenta $asa[nick]</font><br><br>";
$uloha=mysql_fetch_array(mysql_query("SELECT * FROM mib_uloha WHERE clenid='$h->id'",$spojenie));
$zadal=mysql_fetch_array(mysql_query("SELECT nick FROM mib_alluser WHERE id='$uloha[zadal]'",$spojenie));
echo "<hr><blockquote>Dátum: ".generate_date($uloha[id],"sec")." (zadal: $zadal[0]): $uloha[uloha]</blockquote><hr>";
echo "</center>";
?>