<?php
include_once 'model/timeline.php';
class TimelineContro extends Timeline
{
    public function __construct()
    {
    }
    public function addNewTimeLine($name, $user, $document = null)
    {
        date_default_timezone_set("Asia/Kuwait");
        $hour = date("H:i");
        $date = date('d-m-Y');
        $this->newTimeLine($name, $user, $document, $hour, $date);
    }
    public function getAllTimeLine()
    {
        return $this->getAll();
    }
    public function summary()
    {
        return $this->getSummary();
    }
    public function summaryAll()
    {
        return $this->getSummaryAll();
    }
    public function staffAll()
    {
        return $this->getStaffAll();
    }
    public function getDocumentLevel()
    {
        return $this->getDocumentLevelAll();
    }
}
