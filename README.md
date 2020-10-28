# Task

## Set up

1. run `composer install`
2. set up the default task json file `make reset`
3. run the server `make reset`
4. run the tests `make test`

## Makefile

| Make Command  | Description                                                |
|---------------|------------------------------------------------------------|
| start         | starts the web server (localhost:8080)                     |
| test          | runs the unit tests                                        |
| filter test=y | run specific or groups of tests (make filter test=testAll) |
| reset         | resets the json file                                       |

## Endpoints

| Endpoint     | Method | Descriptions            | Response code |
|--------------|--------|------------------------ |---------------|
| /tasks       | GET    | Get a list of all tasks | 200           |   
| /tasks/{$id} | GET    | Get a singular task     | 200           | 
| /tasks       | POST	| Create new task	      | 201           |
| /tasks/{$id} | PUT	| Update a task  	      | 200           |
| /tasks/{$id} | DELETE	| Delete a task 	      | 200           |


### /tasks:POST Parameters


| Parameter   | Type           | Notes    |
|-------------|----------------|----------|
| username    |	string         | required |
| description |	string         | required |
| createAt	  | unix timestamp | optional |
| completed	  | boolean        | optional |

### /tasks{$id}:PUT Parameters

| Parameter   | Type           | Notes    |
|-------------|----------------|----------|
| username    |	string         | optional |
| description |	string         | optional |
| createAt	  | unix timestamp | optional |
| completed	  | boolean        | optional |