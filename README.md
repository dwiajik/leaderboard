# Simple Leaderboard for Games
This project is a simple leaderboard API for games. This API will help you to make online leaderboard to compare user scores. This project is now online in [Online Leaderboard](http://leaderboard.dwiajik.com/)


How to use Online Leaderboard:
- Make an instance, instance is like one of your game mode (e.g. Chimory - Classic Mode).
- Open the instance to see the the Instance ID and Instance Password. It will be used to get, insert, update, or delete data.
- Now you can use the API
- To get data, POST request to http://dwiajik.leaderboard.com/api/v1/get with JSON data (example):

  ```json
  {
    "id": "NDc1ZWU5MzQzYmJkNDQzNzlkM",
    "password": "MjkwNzM2ZWViN2JmNGJhNDE5MzM3YzgzMmQzYTYxODA4ZmNhYz",
    "limit": "10"
  } 
  ```
  
  That will return data:
  
  ```json
  {
    "scores": [
        {
            "id": "1",
            "name": "dwiajik",
            "score": "100"
        },
        {
            "id": "3",
            "name": "pleki",
            "score": "20"
        },
        {
            "id": "2",
            "name": "rafika",
            "score": "10"
        }
    ],
    "count": 4
  }
  ```
  
- To get one data, POST request to http://dwiajik.leaderboard.com/api/v1/getById with JSON data (example):

  ```json
  {
    "id": "NDc1ZWU5MzQzYmJkNDQzNzlkM",
    "password": "MjkwNzM2ZWViN2JmNGJhNDE5MzM3YzgzMmQzYTYxODA4ZmNhYz",
    "scoreId": "1"
  }
  ```
  
  That will return data:
  
  ```json
  {
    "score": {
        "id": "1",
        "name": "dwiajik",
        "score": "100"
    },
    "count": 4,
    "rank": 1
  }
  ```
  
- To insert data, POST request to http://dwiajik.leaderboard.com/api/v1/upsert with JSON data (example):

  ```json
  {
    "id": "NDc1ZWU5MzQzYmJkNDQzNzlkM",
    "password": "MjkwNzM2ZWViN2JmNGJhNDE5MzM3YzgzMmQzYTYxODA4ZmNhYz",
    "score": {
      "name": "dwiajik",
      "score": "10"
    }
  }
  ```
  
  That will return data:
  
  ```json
  {
    "id": "7",
    "name": "dwiajik",
    "score": "10",
    "count": 5,
    "rank": 4
  }
  ```
  
- To update data, POST request to http://dwiajik.leaderboard.com/api/v1/upsert with JSON data (example):
  
  ```json
  {
    "id": "NDc1ZWU5MzQzYmJkNDQzNzlkM",
    "password": "MjkwNzM2ZWViN2JmNGJhNDE5MzM3YzgzMmQzYTYxODA4ZmNhYz",
    "score": {
    	"id": "1",
      "name": "dwiajik",
      "score": "100"
    }
  }
  ```
  
  That will return data:
  
  ```json
  {
    "id": "1",
    "name": "dwiajik",
    "score": "100",
    "count": 5,
    "rank": 1
  }
  ```
  
- To delete data, POST request to http://dwiajik.leaderboard.com/api/v1/delete with JSON data (example):
  
  ```json
  {
    "id": "NDc1ZWU5MzQzYmJkNDQzNzlkM",
    "password": "MjkwNzM2ZWViN2JmNGJhNDE5MzM3YzgzMmQzYTYxODA4ZmNhYz",
    "scoreId": "7"
  }
  ```
  
  That will return data:
  
  ```json
  {
    "id": "NDc1ZWU5MzQzYmJkNDQzNzlkM",
    "password": "MjkwNzM2ZWViN2JmNGJhNDE5MzM3YzgzMmQzYTYxODA4ZmNhYz",
    "scoreId": "7"
  }
  ```

Better "how to" and documentation of this project will be added soon.
