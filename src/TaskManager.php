<?php
namespace Task;

class TaskManager
{

    private $json;
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->json = $this->fileManager->openTaskFile();
    }

    public function all()
    {
        return $this->json;
    }

    public function get($id)
    {
        return $this->json[$id];
    }

    public function create(Task $task)
    {
        $this->json[] = $task;
        $this->save();
    }

    public function update($id, Task $task)
    {
        $this->json[$id] = $task;
        $this->save();
    }

    public function delete($id)
    {
        unset($this->json[$id]);
        $this->save();
    }

    private function save()
    {
        return $this->fileManager->saveFile($this->json);
    }
}