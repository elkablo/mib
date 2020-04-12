<?
if ($index->mib!="mib") die ("Access denied");
echo "<center><font class=\"nadpis\">Prebieha odhlásenie</font></center><br><br>";
echo "<script language=javascript>";
echo "setTimeout (\"refreshme()\",1000);\n";
echo "function refreshme() {\n";
echo "parent.location = \"index.php\";\n";
echo "}\n";
echo "</script>";
?>