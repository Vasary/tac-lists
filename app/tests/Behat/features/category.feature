Feature:
    Category

    Background:
        Given clean database
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru

    Scenario: Create
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "POST" request to "/api/v1/category" with body:
          """
          {
              "name": "vegetables",
              "color": "#00FF00"
          }
          """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | name  | vegetables |
            | color | #00FF00    |

    Scenario: Get
        Given category fruits for ru with id ee245dca-339a-42d6-919a-065c1dca441c
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/category/ee245dca-339a-42d6-919a-065c1dca441c"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | id     | ee245dca-339a-42d6-919a-065c1dca441c |
            | name   | fruits                               |
            | color  | #FFFFFF                              |
            | region | ru                                   |
        And the JSON node created should exist
        And the JSON node updated should exist

    Scenario: All
        Given category fruits for ru with id ee245dca-339a-42d6-919a-065c1dca441c
        Given category vegetables for ru with id 7b1e1636-0fb4-4163-b23d-c4cf25096eb8
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/categories"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node categories should exist
        And the JSON node categories should have 2 element

    Scenario: List for different regions
        Given category fruits for ru with id ee245dca-339a-42d6-919a-065c1dca441c
        Given category vegetables for az with id 7b1e1636-0fb4-4163-b23d-c4cf25096eb8
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/categories"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node categories should exist
        And the JSON node categories should have 1 element

    Scenario: Not exists
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/category/ee245dca-339a-42d6-919a-065c1dca441c"
        Then the response should be in JSON
        And the response status code should be 404
