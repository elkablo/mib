<?
if ($index->mib!="mib") die ("Access denied");
echo "<center><font class=\"nadpis\">Správy</font><br><br>";
if (!$page) $page=1;
if ($delete=="ok") {
if ($dok!="ok") { echo "Naozaj chcete vymazať správu s id $co?<br><a href=\"index.php?action=sprava&delete=ok&co=$co&dok=ok&ktrspr=$ktrspr&page=$page\">Áno</a> | <a href=\"index.php?action=sprava&ktrspr=$ktrspr&page=$page\">Nie</a><br><br>"; }
elseif ($dok=="ok") {
mysql_query("DELETE FROM mib_sprava WHERE id='$co'",$spojenie);
echo "Správa $co bola zmazaná.<br><br>";
}
}
echo "<script language=javascript>\n";
echo "<!--\n";
echo "var popUpWin = 0;";
echo "function citaj(id) {\n";
echo "if (popUpWin && !popUpWin.closed) popUpWin.close();\n";
echo "popUpWin = window.open(\"sprava-citaj.php?spravaid=\"+id,\"AB\",\"scrollbars=yes,status=no,width=600,height=400,menubar=no,resizable=no,directories=no\");\n";
echo "}\n";
echo "var popUpWin2 = 0;";
echo "function pis() {\n";
echo "if (popUpWin && !popUpWin.closed) popUpWin.close();\n";
echo "popUpWin2 = window.open(\"sprava-pis.php\",\"CD\",\"scrollbars=yes,status=no,width=600,height=400,menubar=no,resizable=no,directories=no\");\n";
echo "}\n";
echo "-->\n";
echo "</script>\n";
if ($ktrspr=="prijate") { $wh="toid"; $ch1s=" SELECTED"; $cco="Odosielateľ"; }
elseif ($ktrspr=="odoslane") { $wh="fromid"; $ch2s=" SELECTED"; $cco="Príjemca"; $epl="<blockquote>Pokiaľ odoslané správy príjemca vymazal, sú vymazané aj vo vašom zozname.</blockquote><br>"; }
else { $wh="toid"; $ch1s=" SELECTED"; $cco="Odosielateľ"; }
echo "</center><form method=\"post\"><select name=\"ktrspr\"><option value=\"prijate\"$ch1s>Prijaté</option><option value=\"odoslane\"$ch2s>Odoslané</option></select><input type=\"submit\" value=\">>\">&nbsp;&nbsp;&nbsp;<a href=\"javascript:pis()\">Poslať správu</a></form>$epl<center>";
$prikaz="SELECT * FROM mib_sprava WHERE ".$wh."='$h->id' ORDER BY id ASC LIMIT ".($page-1)*"20".","."20";
$vysledok=mysql_query($prikaz,$spojenie);
echo "<table width=\"95%\"><tr><td>Dátum</td><td>$cco</td><td>Predmet</td><td>Stav</td><td>Možnosti</td></tr>";
while($zaznam=mysql_fetch_array($vysledok)) {
$from=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id=$zaznam[fromid]",$spojenie));
$to=mysql_fetch_array(mysql_query("SELECT * FROM mib_alluser WHERE id=$zaznam[toid]",$spojenie));
if ($ktrspr=="odoslane") { $precit="neprečítaná"; }
else { $precit="<font color=\"#ff0000\"><b>neprečítaná</b></font>"; }
if ($zaznam[precit]=="yes") $precit="prečítaná";
$ktora="prijate";
$kto=$from[nick];
if ($ktrspr=="odoslane") { $ktora="odoslane"; $kto=$to[nick]; }
$subject=substr($zaznam[subject],0,12);
if (strlen($zaznam[subject])>12) $subject.="...";
echo "<tr><td>".generate_date($zaznam[id],"true","xx.xx.xxxx")."</td><td><b>Agent $kto</b></td><td>$subject</td><td>$precit</td><td><a href=\"javascript:citaj(".$zaznam[id].")\">Prečítať</a> | <a href=\"index.php?action=sprava&delete=ok&co=$zaznam[id]&ktrspr=$ktora&page=$page\">Vymazať</a></td></tr>";
}
echo "</table>";
$total=mysql_fetch_array(mysql_query("SELECT count(id) FROM mib_sprava WHERE ".$wh."='$h->id'",$spojenie));
echo "<br><hr>Strana: ";
for ($i=0;$i<$total[0];$i=$i+20) {
 $ppage++;
 if ($ppage==$page) { $exit="<b>".($i/20+1)."</b>&nbsp;"; }
 if ($ppage!=$page) { $exit="<b><a href=\"index.php?action=sess&page=".($i/20+1)."\">".($i/20+1)."</a></b>&nbsp;"; }
 echo $exit;
}
echo "</center>";
?>