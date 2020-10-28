<?php
namespace Task;

class FileManager
{

    private $filepath;

    public function __construct($filepath = 'storage/tasks.json')
    {
        $this->filepath = $filepath;
    }

    public function openTaskFile()
    {
        $jsonFileContent = json_decode(file_get_contents($this->filepath));
        return $this->hydrate($jsonFileContent);
    }

    public function saveFile($json)
    {
        return file_put_contents($this->filepath, json_encode($json));
    }

    private function hydrate($json)
    {
        $tasks = [];
        foreach ($json as $item){
            $tasks[] = new Task((array) $item);
        }

        return $tasks;
    }

}