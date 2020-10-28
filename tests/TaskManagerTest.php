<?php

namespace Task\Tests;
require 'vendor/autoload.php';

use Mockery;
use PHPUnit\Framework\TestCase;
use Task\FileManager;
use Task\Task;
use Task\TaskManager;

class TaskManagerTest extends TestCase
{

    private $fileManager;

    public function setUp(): void
    {
        parent::setUp();

        $this->fileManager = Mockery::mock(FileManager::class);
        $this->fileManager->shouldReceive('openTaskFile')
            ->andReturns($this->tasks());
        $this->fileManager->shouldReceive('saveFile');
    }

    public function tasks()
    {
        return [
            new Task(['username' => 'example', 'description' => 'Task 1']),
            new Task(['username' => 'example', 'description' => 'Task 2']),
            new Task(['username' => 'example', 'description' => 'Task 3']),
        ];
    }

    public function testAll()
    {
        $taskManger = new TaskManager($this->fileManager);

        $this->assertCount(3, $taskManger->all());
    }

    /**
     * @dataProvider getDataProvider
     */
    public function testGet($key, $task)
    {
        $taskManger = new TaskManager($this->fileManager);

        $this->assertEquals($task, $taskManger->get($key));
    }

    public function testUpdate()
    {
        $updatedTask = new Task(['username' => 'task-new', 'description' => 'new']);
        $taskManger = new TaskManager($this->fileManager);
        $taskManger->update(0, $updatedTask);

        $this->assertEquals($updatedTask, $taskManger->get(0));
    }

    public function testCreate()
    {
        $newTask = new Task(['username' => 'task-new', 'description' => 'new']);
        $taskManger = new TaskManager($this->fileManager);
        $taskManger->create($newTask);

        $this->assertEquals($newTask, $taskManger->get(3));
    }

    public function testDelete()
    {
        $taskManger = new TaskManager($this->fileManager);
        $taskManger->delete(2);

        $this->assertNull($taskManger->get(3));
    }

    public function getDataProvider()
    {
        $getAsserts = [];
        foreach ($this->tasks() as $i => $task){
            $getAsserts["Task {$i}"] = ['key' => $i, 'assert' => $task];
        }

        return $getAsserts;
    }

}