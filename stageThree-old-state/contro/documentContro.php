<?php
include_once 'model/document.php';
class DocumentContro extends Document
{
    private $userID;
    private $file;
    private $title;
    private $level;
    private $date;
    private $documentID;

    public function __construct($userID = null, $file = null, $title = null, $level = null, $date = null, $documentID = null)
    {
        $this->userID = $userID;
        $this->file = $file;
        $this->title = $title;
        $this->level = $level;
        $this->date = $date;
        $this->documentID = $documentID;
    }
    public function document()
    {
        $this->saveDocumentPath($this->userID, $this->file, $this->title, $this->level, $this->date);
    }
    public function getDocument($userID = null)
    {
        return $this->getAllDocument($userID);
    }
    public function deleteDocument($file)
    {
        $this->deleteDocumentById($file);
    }
    public function getDocumentPath($filePath)
    {
        return $this->getDocumentByPath($filePath);
    }
    public function updateDocument()
    {
        $this->updateDocumentByID($this->userID, $this->file, $this->title, $this->level, $this->date, $this->documentID);
    }
    public function updateDocumentNoFile($userID, $title, $level, $date, $documentID)
    {
        $this->updateDocumentByIDNoFile($userID, $title, $level, $date, $documentID);
    }
    public function getDocumentByPaths($id)
    {
        return $this->getAllDocumentByPathID($id);
    }
}
