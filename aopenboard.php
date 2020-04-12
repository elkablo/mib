<?
if ($index->mib!="mib") die ("Access denied");
$abc=mysql_fetch_array(mysql_query("SELECT * FROM mib_board_name WHERE id='$boardid'",$spojenie));
echo "<center><font class=\"nadpis\">FÓRUM: $abc[name]</font></center><br><br>";
if ($sendboard=="ano") {
$vulgarny=array("piča","piči","chuj","kokot","kurv","pič","fuck","dick","pind");
if ($sendauthor=="" && $h->ok!="ok") { echo "<font color=\"#ff0000\"><center><b>Musíte zadať Nick!</b></center></font>"; }
elseif ($textboard=="") { echo "<font color=\"#ff0000\"><center><b>Musíte zadať text!</b></center></font>"; }
elseif (obsahuje($textboard,$vulgarny)) { echo "<center><b><font color=\"#ff0000\">Zadali ste príliš vulgárne výrazy. Opravte ich!</b></center></font>"; }
else {
$textboard=EregI_Replace("
","<br>",$textboard);
if ($h->ok=="ok") { $asd=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id='$h->id'",$spojenie)); $sendauthor="Agent ".$asd[nick]; }
mysql_query("INSERT INTO mib_board VALUES('$idtime','$sendauthor','$textboard','$boardid','$REMOTE_ADDR','$authormail')",$spojenie);
$textboard="";$sendauthor="";$authormail="";
}
}
echo "<form method=\"post\"><input type=\"hidden\" name=\"sendboard\" value=\"ano\"><table><tr><td>Nick:</td><td>";
if ($h->ok=="ok") { $asd=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id='$h->id'",$spojenie)); echo "<b>Agent $asd[nick]</b>"; } else { echo "<input type=\"text\" name=\"sendauthor\" value=\"$sendauthor\">"; }
echo "</td></tr><tr><td>E-mail:</td><td><input type=\"text\" name=\"authormail\" value=\"$authormail\"></td></tr><tr><td>Text:</td><td><textarea cols=\"0\" name=\"textboard\" style=\"width:291; height:58\">$textboard</textarea></td></tr><tr><td>Pridať >></td><td><input type=\"submit\" value=\" Pridať \"></td></tr></table></form>";
if (!$page) { $page="1"; }
$board_str=10;
$prikaz="SELECT * FROM mib_board WHERE boardid LIKE '$boardid' ORDER BY id DESC LIMIT ".($page-1)*"$board_str".","."$board_str";
$vysledok=mysql_query($prikaz,$spojenie);
while ($zaznam=mysql_fetch_array($vysledok)) {
echo "<hr>";
if ($zaznam[mail]!="") { $mailx="<a class=\"body\" href=\"mailto:$zaznam[mail]\">"; $maily="</a>"; }
echo "<table width=\"550\"><tr><td><table><tr><td width=\"30%\"><b>$mailx$zaznam[author]$maily</b></td><td width=\"70%\">Pridané: ".generate_date($zaznam[id],"sec")." | $zaznam[ip]</td></tr></table></td></tr><tr><td><font class=\"text\">$zaznam[text]</font></td></tr></table>";
$mailx="";$maily="";
}
echo "<center>";
$total=mysql_fetch_array(mysql_query("SELECT count(id) FROM mib_board WHERE boardid LIKE '$boardid'",$spojenie));
echo "<br><hr>Strana: ";
for ($i=0;$i<$total[0];$i=$i+$board_str) {
 $ppage++;
 if ($ppage==$page) { $exit="<b>".($i/$board_str+1)."</b>&nbsp;"; }
 if ($ppage!=$page) { $exit="<b><a href=\"index.php?action=openboard&boardid=$boardid&page=".($i/$board_str+1)."\">".($i/$board_str+1)."</a></b>&nbsp;"; }
echo $exit;
 }
echo "</center>";
?>