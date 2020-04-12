<?
mysql_query("DELETE FROM mib_sprava WHERE (id<=".($idtime-604800).")",$spojenie);
mysql_query("DELETE FROM mib_sess WHERE (id<=".($idtime-(30*60)).") AND (type LIKE 'mib' OR type LIKE 'admin')",$spojenie);
mysql_query("DELETE FROM mib_sess WHERE (id<=".($idtime-(5*60)).") AND type LIKE 'visit'",$spojenie);
if ($index->mib!="mib") die ("Access denied");
$zaznam=mysql_fetch_array(mysql_query("SELECT * FROM mib_sess WHERE sessid LIKE '$cooksess' AND ip='$REMOTE_ADDR' AND (type LIKE 'visit' OR type LIKE 'mib' OR type LIKE 'admin')",$spojenie));
if ($action=="logout") {
setcookie("cooksess");
mysql_query("DELETE FROM mib_sess WHERE sessid LIKE '$cooksess'",$spojenie);
} elseif ($zaznam && $sent!="ok") {
setcookie("cooksess",$cooksess,time()+(30*60));
mysql_query("UPDATE mib_sess SET id=$idtime WHERE sessid LIKE '$cooksess' AND ip='$REMOTE_ADDR'",$spojenie);
$h->type=$zaznam[type];
if ($h->type=="mib" || $h->type=="admin") { $h->ok="ok"; }
$h->id=$zaznam[userid];
} elseif ($sent=="ok") {
$udaje=mysql_fetch_array(mysql_query("SELECT id, nick, heslo, type FROM mib_alluser WHERE nick='$dname'",$spojenie));
if ($udaje[2]==md5($dpass)) {
mysql_query("DELETE FROM mib_sess WHERE sessid LIKE '$cooksess' AND ip LIKE '$REMOTE_ADDR'",$spojenie);
if ($udaje[3]=="admin") { mysql_query("INSERT INTO mib_sess VALUES ('$cooksess','$idtime','$udaje[0]','$REMOTE_ADDR','admin')",$spojenie); $h->type="admin"; $h->id=$udaje[0]; $h->ok="ok"; }
elseif ($udaje[3]=="mib") { mysql_query("INSERT INTO mib_sess VALUES ('$cooksess','$idtime','$udaje[0]','$REMOTE_ADDR','mib')",$spojenie); $h->type="mib"; $h->id=$udaje[0]; $h->ok="ok"; }
mysql_query("UPDATE mib_alluser SET lastsession='$idtime' WHERE id='$udaje[id]'",$spojenie);
unset($action);
} elseif (!$udaje) { $loginerror="<tr><td align=\"center\" colspan=\"2\"><b>CHYBA!</b></td></tr>"; } elseif ($mddpass!=$udaje[2]) { $loginerror="<tr><td align=\"center\" colspan=\"2\"><b>CHYBA!</b></td></tr>"; }
else { $loginerror="<tr><td align=\"center\" colspan=\"2\"><b>CHYBA!</b></td></tr>"; }
} elseif (!$zaznam && $sent!="ok") {
$ses=MD5(UniqID(microtime()*REMOTE_ADDR));
setcookie("cooksess",$ses,time()+(30*60));
mysql_query("INSERT INTO mib_sess VALUES ('$ses','$idtime','0','$REMOTE_ADDR','visit')",$spojenie);
$h->type="visit";
$h->id="0";
}
?>