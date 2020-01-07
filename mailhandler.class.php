<?php
class mailhandler
{
    private $_MailBox;

    public function __construct($mailhost, $username, $password)
    {
        mb_internal_encoding("UTF-8");
        $this->_Mailbox = imap_open($mailhost, $username, $password);
    }

    public function __destruct()
    {
        @imap_close($this->_MailBox);
    }

    public function GetNumberOfEmails()
    {
        $result = 0;
        $list = imap_headers($this->_Mailbox);
        if (is_array($list)) {
            $result = count($list);
        }        
        return $result;
    }

    public function GetBodyOfEmail($mailNumber)
    {
        $result = "";
        if ($mailNumber <= $this->GetNumberOfEmails())
        {
            $result = imap_fetchbody($this->_Mailbox, $mailNumber, 2);
        }
        return $result;
    }

    public function DeleteMail($mailNumber)
    {
        imap_delete($this->_Mailbox, $mailNumber);        
    }


    public function CloseAndPurgeMailBox()
    {
        imap_close($this->_Mailbox, CL_EXPUNGE);
    }    
}
?>