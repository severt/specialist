<?php
$dt1 = new \DateTime('1961-04-12');
echo $datedif = $dt1->getTimestamp();
echo '<br>';
$dt2 = $dt1->setTimestamp($datedif);
var_dump($dt2);echo '<br>';
$dt2->setTimezone(new \DateTimeZone('Europe/Vatican')); // или другой нужный часовой пояс
var_dump($dt2);echo '<br>';
echo $dt1->format('Y/m/d H:i:s') . "<br>";
