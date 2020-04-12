<?
$index->mib="mib";
include "_db.connect.php";
include "include.php";
$idtime=date("U");
include "heslo.php";
$zaznam=mysql_fetch_array(mysql_query("SELECT * FROM mib_sess WHERE ip LIKE '$REMOTE_ADDR' AND (type LIKE 'admin' or type LIKE 'mib') AND sessid='$cooksess'",$spojenie));
if (!$zaznam) die ("Vstup blokovaný!");
$zaznamsprava=mysql_fetch_array(mysql_query("SELECT * FROM mib_sprava WHERE id LIKE '$spravaid'",$spojenie));
$from=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id='$zaznamsprava[fromid]'",$spojenie));
$to=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id='$zaznamsprava[toid]'",$spojenie));
if ($zaznamsprava[toid]==$h->id) {
if ($from[nick]) { $nick=$from[nick]; }
else { $nick="unknown"; }
} elseif ($zaznamsprava[fromid]==$h->id) {
if ($to[nick]) { $nick=$to[nick]; }
else { $nick="unknown"; }
}
if ($zaznamsprava[toid]==$h->id) {
mysql_query("UPDATE mib_sprava SET precit='yes' WHERE id LIKE '$spravaid'",$spojenie);
}
if ($zaznamsprava[toid]==$h->id) { $s="Od"; $m="od"; $zp="<br><a href=\"sprava-pis.php?komu=".$zaznamsprava[fromid]."&subject=Re:%20".$zaznamsprava[subject]."\">Odpovedať</a>"; }
elseif ($zaznamsprava[fromid]==$h->id) { $s="Pre"; $m="pre"; }
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">

<!-- Copyright © 2005 MEN in BLACK, all right reserved -->

<html><head><title>MiB - Správa $m: Agent $nick</title><style>";
include "style.php";
echo "</style>";
echo "</head><body>";
echo "<center><font class=\"nadpis\">Správa $m: Agent $nick</font></center><br><br>Text správy:<br><br>";
echo $s.": Agent $nick<br>Predmet: $zaznamsprava[subject]<br>";
echo "<hr>".$zaznamsprava[sprava]."<hr>$zp<br><br>Správa sa po prečítaní do 7 dní automaticky vymaže.<br><br><a href=\"javascript:window.close()\">Zavrieť!</a>";
echo "</body></html>";
?>