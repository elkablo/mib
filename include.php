<?
if ($index->mib!="mib") die ("Access denied");

function binarys($b) {
$kb=1024;
$mb=1024*1024;
$gb=1024*1024*1024;
if ($b<$kb) { $vysledok=$b." b"; }
elseif ($b==$kb) { $vysledok="1 kb"; }
elseif ($kb<$b) {
if ($b<$mb) { $vysledok=sprintf("%.2f",$b/$kb)." kb"; }
elseif ($b==$mb) { $vysledok="1 mb"; }
elseif ($mb<$b) {
if ($b<gb) { $vysledok=sprintf("%.2f",$b/$mb)." mb"; }
elseif ($b==$gb) { $vysledok="1 gb"; }
elseif ($gb<$b) { $vysledok=sprintf("%.2f",$b/$gb)." gb"; }}}
return $vysledok;
}

function generate_date($time,$timeon=false,$ako=false) {
 switch (date("w",$time)) {
  case "1": $week="Pondelok";break;
  case "2": $week="Utorok";break;
  case "3": $week="Streda";break;
  case "4": $week="Štvrtok";break;
  case "5": $week="Piatok";break;
  case "6": $week="Sobota";break;
  case "0": $week="Nedeľa";break;
 }

 $day=date("j",$time);
 switch (date("m",$time)) {
  case "01": $month="Januára";break;
  case "02": $month="Februára";break;
  case "03": $month="Marca";break;
  case "04": $month="Apríla";break;
  case "05": $month="Mája";break;
  case "06": $month="Júna";break;
  case "07": $month="Júla";break;
  case "08": $month="Augusta";break;
  case "09": $month="Septembra";break;
  case "10": $month="Októbra";break;
  case "11": $month="Novembra";break;
  case "12": $month="Decembra";break;
 }
 $year=date("Y",$time);
$outputdate="$week, $day. $month $year";
 if ($timeon=="true") {
  $outputdate.=(" ".date("H:i",$time));
 }
if ($timeon=="sec") {
  $outputdate.=(" ".date("H:i:s",$time));
 }
if ($ako=="xx.xx.xxxx") { $outputdate="$day.".date("m",$time).".$year"; }
 return $outputdate;
}

function obsahuje($from,$words) {
if ($words):
 for ($f=0;$f<Count($words);$f++):
  if ($f==0) $regstr.=($words[$f]);
  if ($f!=0) $regstr.=("|".$words[$f]);
 endfor;

 if (ERegI (".*([[:space:]]|^)(".$regstr.").*",$from)==true) {
  return true;
 } else {
  return false;
 }
endif;
}

function prevrat($co) {
 $pocet=strlen($co);
 for ($i=$pocet-1;$i>-1;$i--) {
  $xxx=substr($co,$i,1);
  $new.=$xxx;
 }
 return $new;
}
?>