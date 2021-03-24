Feature:
    Item

    Background:
        Given clean database
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru
        Given unit Kilogram as kg for ru with id 03e65530-57ed-471b-b4eb-fbdaed53d181
        Given list my list with id 4c907523-ef31-470f-b0ab-8b72bc11527e
        Given category vegetables for ru with id f4f6e817-18e9-438d-932d-e028b792292d
        Given template potato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in f4f6e817-18e9-438d-932d-e028b792292d category with id bcb5812b-a46c-43d7-9e4e-eff7666ff9bc

    Scenario: Create
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "POST" request to "/api/v1/item" with body:
          """
          {
              "template": "bcb5812b-a46c-43d7-9e4e-eff7666ff9bc",
              "list": "4c907523-ef31-470f-b0ab-8b72bc11527e",
              "unit": "03e65530-57ed-471b-b4eb-fbdaed53d181",
              "value": 1,
              "points": [
                            {
                                "longitude": 55.751244,
                                "latitude": 37.618423,
                                "comment": "Moscow"
                            }
                        ],
              "images": ["https://project.localhost/1.png"]
          }
          """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node isPurchased should be false
        And the JSON node id should exist
        And the JSON node created should exist
        And the JSON node updated should exist
        And the JSON node id should exist
        And the JSON node labels should have 0 element
        And the JSON node points should have 1 element
        And the JSON node images should have 1 element
        And the JSON nodes should be equal to:
            | template      | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | list          | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | unit          | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | order         | 0                                    |
            | value         | 1                                    |

    Scenario: Touch
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 4c907523-ef31-470f-b0ab-8b72bc11527e
        Given there is a item:
            | id        | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template  | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | unit      | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | list      | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | value     | 1                                    |
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "PUT" request to "/api/v1/item/touch" with body:
          """
          {
              "id": "6d62c6a6-3368-4dad-8dbd-3227915317ff"
          }
          """
        Then the response status code should be 200
        And the JSON node isPurchased should exist
        And the JSON node isPurchased should be true

    Scenario: Update
        Given list my list with id af126249-b348-40b4-8939-4350e15bb4af
        Given unit Kilogram as kg for ru with id a9cf2197-9857-4140-a479-825d2cab39f6
        Given template tomato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in f4f6e817-18e9-438d-932d-e028b792292d category with id c8305ae6-93d8-46d5-b54e-df75c991310d
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 4c907523-ef31-470f-b0ab-8b72bc11527e
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list af126249-b348-40b4-8939-4350e15bb4af

        Given there is a item:
            | id        | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template  | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | unit      | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | list      | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | value     | 1                                    |
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "PUT" request to "/api/v1/item" with body:
          """
          {
              "id": "6d62c6a6-3368-4dad-8dbd-3227915317ff",
              "template": "c8305ae6-93d8-46d5-b54e-df75c991310d",
              "list": "af126249-b348-40b4-8939-4350e15bb4af",
              "unit": "a9cf2197-9857-4140-a479-825d2cab39f6",
              "order": 10,
              "value": 11,
              "points": [
                            {
                                "longitude": 55.751244,
                                "latitude": 37.618423,
                                "comment": "Moscow"
                            },
                            {
                                "longitude": 40.730610,
                                "latitude": -73.935242,
                                "comment": "New York"
                            }
                        ],
              "images": [
                            "https://project.localhost/1.png",
                            "https://project.localhost/2.png",
                            "https://project.localhost/3.png"
                        ]
          }
          """
        Then the response status code should be 200
        And the JSON node labels should have 0 element
        And the JSON node images should have 3 element
        And the JSON node points should have 2 element
        And the JSON node created should exist
        And the JSON node updated should exist
        And the JSON nodes should be equal to:
            | id            | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template      | c8305ae6-93d8-46d5-b54e-df75c991310d |
            | unit          | a9cf2197-9857-4140-a479-825d2cab39f6 |
            | list          | af126249-b348-40b4-8939-4350e15bb4af |
            | order         | 10                                   |
            | value         | 11                                   |


    Scenario: Delete not own
        Given there is a item:
            | id        | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template  | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | unit      | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | list      | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | value     | 1                                    |
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "DELETE" request to "/api/v1/item/6d62c6a6-3368-4dad-8dbd-3227915317ff"
        Then the response status code should be 403

    Scenario: Delete own
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 4c907523-ef31-470f-b0ab-8b72bc11527e
        Given there is a item:
            | id        | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template  | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | unit      | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | list      | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | value     | 1                                    |
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "DELETE" request to "/api/v1/item/6d62c6a6-3368-4dad-8dbd-3227915317ff"
        Then the response status code should be 200

    Scenario: Get
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 4c907523-ef31-470f-b0ab-8b72bc11527e
        Given there is a item:
            | id        | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template  | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | unit      | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | list      | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | value     | 1                                    |
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a GET request to "/api/v1/item/6d62c6a6-3368-4dad-8dbd-3227915317ff"
        Then the response status code should be 200
        And the JSON node labels should have 0 element
        And the JSON node images should have 0 element
        And the JSON node points should have 0 element
        And the JSON node isPurchased should be false
        And the JSON node created should exist
        And the JSON node updated should exist
        And the JSON nodes should be equal to:
            | template      | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | list          | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | unit          | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | order         | 0                                    |
            | value         | 1                                    |
