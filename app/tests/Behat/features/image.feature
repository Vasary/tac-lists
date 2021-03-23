Feature:
    Images

    Background:
        Given clean database
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru
        Given unit Kilogram as kg for ru with id 03e65530-57ed-471b-b4eb-fbdaed53d181
        Given list my list with id 4c907523-ef31-470f-b0ab-8b72bc11527e
        Given category vegetables for ru with id f4f6e817-18e9-438d-932d-e028b792292d
        Given template potato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in f4f6e817-18e9-438d-932d-e028b792292d category with id bcb5812b-a46c-43d7-9e4e-eff7666ff9bc

    Scenario: Get item images
        Given there is a item:
            | id        | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template  | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | unit      | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | list      | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | value     | 1                                    |
        Given the image http://localhost/1.png for item 6d62c6a6-3368-4dad-8dbd-3227915317ff with id 3eb2b09c-a5f7-4de8-8698-f3252bee57e9
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 4c907523-ef31-470f-b0ab-8b72bc11527e
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/image/3eb2b09c-a5f7-4de8-8698-f3252bee57e9"
        And the response status code should be 200
        And the response should be in JSON
        And the JSON node id should exist
        And the JSON node link should exist
        And the JSON nodes should be equal to:
            | id   | 3eb2b09c-a5f7-4de8-8698-f3252bee57e9 |
            | link | http://localhost/1.png               |

    Scenario: Get not own image
        Given there is a item:
            | id        | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template  | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | unit      | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | list      | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | value     | 1                                    |
        Given the image http://localhost/1.png for item 6d62c6a6-3368-4dad-8dbd-3227915317ff with id 3eb2b09c-a5f7-4de8-8698-f3252bee57e9
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/image/3eb2b09c-a5f7-4de8-8698-f3252bee57e9"
        And the response status code should be 403
        And the response should be in JSON

    Scenario: Get template images
        Given the image http://localhost/1.png for template bcb5812b-a46c-43d7-9e4e-eff7666ff9bc with id c9602ff5-98da-48a2-bade-b26570d036d8
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/image/c9602ff5-98da-48a2-bade-b26570d036d8"
        And the response status code should be 200
        And the response should be in JSON
        And the JSON node id should exist
        And the JSON node link should exist
        And the JSON nodes should be equal to:
            | id   | c9602ff5-98da-48a2-bade-b26570d036d8 |
            | link | http://localhost/1.png               |
