<?
if ($index->mib!="mib") die ("Access denied");
echo "<table width=\"100%\" background=\"images/bcmenu.png\"><tr><td align=\"center\" class=\"menunadpis\">Hlavné menu</td></tr></table>";
echo "<table width=\"100%\"><tr><td>";
if ($h->ok!="ok") {
echo "<a href=\"index.php\" class=\"menul\">Úvod</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=omib\" class=\"menul\">O MiB</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=film1\" class=\"menul\">Film 1</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=film2\" class=\"menul\">Film 2</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=board\" class=\"menul\">Fórum</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=login\" class=\"menul\">Login</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=info\" class=\"menul\">Kontakt</a><br><font class=\"menubr\"><br></font>";
} elseif ($h->type=="mib") {
echo "<a href=\"index.php\" class=\"menul\">Úvod</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=uloha\" class=\"menul\">Vaša úloha</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=sprava\" class=\"menul\">Správy</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=board\" class=\"menul\">Fórum</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=download\" class=\"menul\">Download</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=udaje\" class=\"menul\">Vaše údaje</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=setpass\" class=\"menul\">Zmena hesla</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=logout\" class=\"menul\">Logout</a><br><font class=\"menubr\"><br></font>";
} elseif ($h->type=="admin") {
echo "<a href=\"index.php\" class=\"menul\">Úvod</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=clen\" class=\"menul\">Agenti</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=uloha\" class=\"menul\">Úlohy agentov</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=sprava\" class=\"menul\">Správy</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=board\" class=\"menul\">Fórum</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=download\" class=\"menul\">Download</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=sess\" class=\"menul\">Session</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=udaje\" class=\"menul\">Vaše údaje</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=setpass\" class=\"menul\">Zmena hesla</a><br><font class=\"menubr\"><br></font>";
echo "<a href=\"index.php?action=logout\" class=\"menul\">Logout</a><br><font class=\"menubr\"><br></font>";
}
echo "</td></tr></table>";
echo "<table width=\"100%\" background=\"images/bcmenu.png\"><tr><td align=\"center\" class=\"menunadpis\">Fórum</td></tr></table>";
echo "<table width=\"100%\"><tr><td>";
if ($h->type=="mib") { $wh=" WHERE type LIKE 'formib' "; }
elseif ($h->type=="admin") { $wh=" "; }
else { $wh=" WHERE type LIKE 'forall' "; }
$prikaz="SELECT * FROM mib_board_name".$wh."ORDER BY id DESC";
$vysledok=mysql_query($prikaz,$spojenie);
while ($zaznam=mysql_fetch_array($vysledok)) {
$pocet=mysql_fetch_array(mysql_query("SELECT count(id) FROM mib_board WHERE boardid='$zaznam[id]'",$spojenie));
$zzz=mysql_fetch_array(mysql_query("SELECT * FROM mib_board WHERE boardid='$zaznam[id]' ORDER BY id DESC LIMIT 1",$spojenie));
echo "<a href=\"index.php?action=openboard&boardid=$zaznam[id]\" title=\"$zaznam[name] - založená: ".generate_date($zaznam[id],"sec")."\" class=\"menul\">$zaznam[name]</a> <font title=\"Posledný príspevok: ".generate_date($zzz[id],"sec")."\">($pocet[0])</font><br><font class=\"menubr\"><br></font>";
}
echo "</td></tr></table>";
echo "<table width=\"100%\" background=\"images/bcmenu.png\"><tr><td align=\"center\" class=\"menunadpis\">Info</td></tr></table>";
echo "<table width=\"100%\"><tr><td>";
if ($h->type=="admin") {
$sessvisit=mysql_fetch_array(mysql_query("SELECT count(sessid) FROM mib_sess WHERE type LIKE 'visit'",$spojenie));
$sessmib=mysql_fetch_array(mysql_query("SELECT count(sessid) FROM mib_sess WHERE (type LIKE 'mib' OR type LIKE 'admin')",$spojenie));
echo "Naše stránky si spolu číta ".($sessvisit[0]+$sessmib[0])." ľudí, z toho je $sessmib[0] prihlásených ako MiB.";
} else {
if ($h->ok!="ok") { $where=" WHERE type LIKE 'visit'"; }
if ($h->ok=="ok") { $where=" WHERE (type LIKE 'mib' OR type LIKE 'admin')"; }
$sess=mysql_fetch_array(mysql_query("SELECT count(sessid) FROM mib_sess".$where,$spojenie));
echo "Naše stránky si práve číta $sess[0] ľudí.";
}
echo "</td></tr></table>";
?>