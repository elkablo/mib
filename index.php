<?
$index->mib="mib";
include "_db.connect.php";
$idtime=date("U");
include "heslo.php";
include "include.php";
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">

<!-- Copyright © 2005 MEN in BLACK, all right reserved -->

<html>
<head>
<meta content=\"MEN in BLACK\" name=\"author\">
<meta content=\"MEN in BLACK\" name=\"description\">
<meta HTTP-EQUIV=\"Content-Type\" Content=\"text-html; charset=utf-8\">
<title>MEN in BLACK</title>
<style>";
include "style.php";
echo "</style>
</head>
<body>";
echo "<table align=\"center\" style=\"WIDTH: 750px\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr height=\"1\"><td class=\"px\" colspan=\"5\"></td></tr>
<tr height=\"100\"><td class=\"px\" width=\"1\"></td><td width=\"748\" align=\"left\"><img src=\"images/indexlogo.png\" width=\"748\" height=\"100\"></td><td class=\"px\" width=\"1\"></td></tr><tr height=\"1\"><td class=\"px\" colspan=\"3\"></td></tr></table>";
echo "<table align=\"center\" style=\"WIDTH: 750px\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td class=\"px\" width=\"1\"></td><td class=\"pnl\" width=\"150\" valign=\"top\">";
include "menu.php";
echo "</td><td class=\"px\" width=\"1\"></td><td class=\"body\" width=\"10\"></td><td class=\"body\" width=\"577\" valign=\"top\"><table><tr height=\"1\"><td></td></tr></table>";

if (!$action) {
if ($h->type=="visit") { include "body.php"; }
elseif ($h->type=="mib") { include "mbody.php"; }
elseif ($h->type=="admin") { include "abody.php"; }
} elseif ($action=="omib") { if ($h->type=="visit") include "omib.php"; }
elseif ($action=="film1") { if ($h->type=="visit") include "film1.php"; }
elseif ($action=="film2") { if ($h->type=="visit") include "film2.php"; }
elseif ($action=="board") {
if ($h->type=="visit") { include "board.php"; }
elseif ($h->type=="mib") { include "board.php"; }
elseif ($h->type=="admin") { include "aboard.php"; }
}
elseif ($action=="openboard") {
if ($h->type=="visit") { include "openboard.php"; }
elseif ($h->type=="mib") { include "openboard.php"; }
elseif ($h->type=="admin") { include "aopenboard.php"; }
}
elseif ($action=="download") {
if ($h->type=="mib") { include "mdownload.php"; }
elseif ($h->type=="admin") { include "adownload.php"; }
}
elseif ($action=="uloha") {
if ($h->type=="mib") { include "muloha.php"; }
elseif ($h->type=="admin") { include "auloha.php"; }
}
elseif ($action=="setpass") { if ($h->ok=="ok") include "setpass.php"; }
elseif ($action=="sprava") { if ($h->ok=="ok") include "sprava.php"; }
elseif ($action=="udaje") { if ($h->ok=="ok") include "udaje.php"; }
elseif ($action=="clen") { if ($h->type=="admin") include "clen.php"; }
elseif ($action=="sess") { if ($h->type=="admin") include "sess.php"; }
elseif ($action=="login") { if ($h->ok!="ok") include "login.php"; }
elseif ($action=="logout") { if ($h->ok!="ok") include "logout.php"; }
elseif ($action=="info") { if ($h->ok!="ok") include "info.php"; }

echo "<table><tr height=\"1\"><td></td></tr></table></td><td class=\"body\" width=\"10\"></td><td class=\"px\" width=\"1\"></td></tr></table>";
echo "<table align=\"center\" style=\"WIDTH: 750px\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td height=\"1\" colspan=\"3\" class=\"px\"></td></tr><tr height=\"18\"><td class=\"px\" width=\"1\"></td><td align=\"right\" class=\"copyright\">Copyright &copy; 2005 by MEN in BLACK&nbsp;</td><td class=\"px\" width=\"1\"></td></tr><tr><td height=\"1\" colspan=\"3\" class=\"px\"></td></tr></table>";
echo "\n</body>
</html>";
?>