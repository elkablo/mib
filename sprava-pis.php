<?
$index->mib="mib";
include "_db.connect.php";
include "include.php";
$idtime=date("U");
include "heslo.php";
$zaznam=mysql_fetch_array(mysql_query("SELECT * FROM mib_sess WHERE ip LIKE '$REMOTE_ADDR' AND (type LIKE 'admin' or type LIKE 'mib') AND sessid='$cooksess'",$spojenie));
if (!$zaznam) die ("Vstup blokovaný!");
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">

<!-- Copyright © 2005 MEN in BLACK, all right reserved -->

<html><head><title>MiB - Písať správu</title><style>";
include "style.php";
echo "</style>";
echo "</head><body>";
echo "<center><font class=\"nadpis\">Písať správu</font><br><br>";

if ($seens=="ok") {
if ($textsprava=="") { echo "<b>Musíte zadať správu!</b><br>"; }
else {
$subject=htmlspecialchars($subject);
$textsprava=htmlspecialchars($textsprava);
$textsprava=str_replace("
","<br>",$textsprava);
$textsprava=str_replace(" ","&nbsp;",$textsprava);
mysql_query("INSERT INTO mib_sprava VALUES('$idtime','$h->id','$komu','$subject','$textsprava','no')",$spojenie);
echo "Správa bola poslaná.<br>";
unset($komu,$textsprava,$subject);
}
}
echo "<table border=\"1\">";
echo "<form method=\"post\"><input type=\"hidden\" name=\"seens\" value=\"ok\"><tr><td>Komu:</td><td><select name=\"komu\" style=\"width: 200px\">";
$vsk=mysql_query("SELECT * FROM mib_alluser WHERE id!='$h->id' ORDER BY id DESC",$spojenie);
while($fsf=mysql_fetch_array($vsk)) {
if ($komu==$fsf[id]) $cs=" SELECTED";
echo "<option value=\"$fsf[id]\"$cs>Agent $fsf[nick]</option>";
unset($cs);
}
echo "</select></td></tr><tr><td>Predmet:</td><td><input type=\"text\" name=\"subject\" value=\"$subject\"></td></tr><tr><td>Správa:</td><td><textarea cols=\"0\" name=\"textsprava\" style=\"width: 400; height: 300\">$textsprava</textarea></td></tr>";
echo "<tr><td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"  OK  \"></td></tr></table></form>";
echo "<br><br><a href=\"javascript:window.close()\">Zavrieť!</a>";
echo "</body></html>";
?>