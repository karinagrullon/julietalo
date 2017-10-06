<html>
<head>

   
   </head>
   
   <body>

<?php
function display_time()
{
   $hour = date("g");
   $minute = date("i");
   $second = date("s");
   $ampm = date("a");
   for ($i=0; $i<=660; $i++){
      $minute = sprintf('%02d', $minute);
      $second = sprintf('%02d', $second);
      echo "<li class='link' id='time$i'>$hour:$minute:$second $ampm </li>";
      $second++;
      if ($second == 60) {
         $second = 0;
         $minute++;
      }
      if ($minute == 60) {
         $minute = 0;
         $hour++;
      }
      if ($hour == 13) {
         $hour = 1;
      }
   }
}
echo display_time();
?>

</body>

</html>