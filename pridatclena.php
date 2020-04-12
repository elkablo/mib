<?
$index->mib="mib";
include "_db.connect.php";
include "include.php";
if (!$step) $step="1";
$zaznam=mysql_fetch_array(mysql_query("SELECT * FROM mib_sess WHERE ip LIKE '$REMOTE_ADDR' AND type LIKE 'admin' AND sessid LIKE '$cooksess'",$spojenie));
if (!$zaznam) die ("Vstup blokovaný!");
$idtime=date(U);
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">

<!-- Copyright © 2005 MEN in BLACK, all right reserved -->

<html><head><title>MiB - Pridať agenta</title><style>";
include "style.php";
echo "</style>";
if ($step=="1") {
echo "<script language=javascript>";
echo "<!--\n";
echo "function validate(formular) {\n";
echo "if (formular.heslo.value!=formular.heslo2.value) {\n";
echo "alert (\"Heslá sa nezhodujú!\");\n";
echo "return false;\n";
echo "} else return true;\n";
echo "}\n";
echo "-->\n";
echo "</script>";
} elseif ($step=="3") {
?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function(){
	$("#atom").fadeTo(0, 0);
	$("#nick").fadeTo(0, 0);
	$("#atom").fadeTo(1000, 1, function(){$("#nick").fadeTo(1000,1);});
});
//-->
</script>
<?
}
echo "</head>";
if ($step=="1" || $step=="2") {
echo "<body>";
echo "<center><font class=\"nadpis\">Pridať agenta</font><br><br>";
if ($step=="1") {
echo "<form method=\"post\" onsubmit=\"return validate(this)\"><input type=\"hidden\" name=\"step\" value=\"2\"><table width=\"50%\"><tr><td width=\"50%\">Nick:</td><td width=\"50%\"><input type=\"text\" name=\"nick\"></td></tr><tr><td>Typ:</td><td><select name=\"type\"><option value=\"mib\">MiB</option><option value=\"admin\">Administrátor</option></select></td></tr><tr><td>Meno:</td><td><input type=\"text\" name=\"meno\"></td></tr><tr><td>Priezvisko:</td><td><input type=\"text\" name=\"prie\"></td></tr><tr><td>Rodné číslo:</td><td><input type=\"text\" name=\"rc\"></td></tr><tr><td>Mail:</td><td><input type=\"text\" name=\"mail\" maxlength=\"255\"></td></tr><tr><td>Heslo:</td><td><input type=\"password\" name=\"heslo\"></td></tr><tr><td>Kontróla hesla:</td><td><input type=\"password\" name=\"heslo2\"></td></tr><tr><td>Ďalej >></td><td><input type=\"submit\" value=\"  OK  \"></td></tr></table>";
} elseif ($step=="2") {
echo "<table width=\"50%\"><tr><td width=\"50%\">Nick:</td><td width=\"50%\">$nick</td></tr><tr><td>Typ:</td><td>$type</td></tr><tr><td>Meno:</td><td>$meno</td></tr><tr><td>Priezvisko:</td><td>$prie</td></tr><tr><td>Rodné číslo:</td><td>$rc</td></tr><tr><td>Mail:</td><td>$mail</td></tr></table><a href=\"javascript:history.back(1)\">Späť</a> | <a href=\"pridatclena.php?step=3&nick=$nick&mail=$mail&heslo=$heslo&meno=$meno&prie=$prie&rc=$rc&type=$type\">Potvrdiť</a>";
}
} elseif ($step=="3") {
$heslo=md5($heslo);
mysql_query("INSERT INTO mib_alluser VALUES('$idtime','$nick','$heslo','$meno','$prie','$rc','$mail','','$type','0')",$spojenie);
echo "<body>";
?><center><font style="color:#00FF00;font-size:25px;font-weight:bold">NEW ENTRY</font>
<div style="position:relative;">
<div id="atom" style="position:absolute;left:15px;top:0px;">
<table width="100%" border="0"><tr><td align="center"><img src="images/atom.gif"></td></tr></table>
</div>
<div id="nick" style="position:absolute;width:200px;height:50px;left:90px;top:36px;color:#00FF00;font-size:60px;font-weight:bold;text-align:center;"><? echo $nick ?></div>
<div id="obsah" style="visibility:hidden;"></div>
</div>
<br><br><br><br><br><br><br><br></center><?
}
echo "<br><br><a href=\"javascript:window.close()\">Zavrieť!</a>";
echo "</body></html>";
?>