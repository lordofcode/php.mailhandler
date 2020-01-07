<?php
require("settings.php");
require("mailhandler.class.php");

header('Content-Type: text/html; charset=utf-8');
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >';

$mailHandler = new mailhandler($mailserver, $emailUserName, $emailPassword);
$emailCount = $mailHandler->GetNumberOfEmails();
echo "Number of mails to process: ".$emailCount."<HR/>";
for ($k=1; $k <= $emailCount; $k++)
{
    $body = $mailHandler->GetBodyOfEmail($k);
    // do something with the body
    //$mailHandler->DeleteMail($k);
}
$mailHandler->CloseAndPurgeMailBox();
echo "<HR/>CONSIDER IT DONE.<HR/>";
?>