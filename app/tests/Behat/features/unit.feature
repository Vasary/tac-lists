Feature:
    Unit

    Background:
        Given clean database
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru
        Given person "6ef50c8f-7148-4cf8-963f-d105f77ee114" in az
        Given unit Gram as gr for ru
        Given unit Liter as l for ru
        Given unit Kilogram as kg for ru with id 03e65530-57ed-471b-b4eb-fbdaed53d181

    Scenario: Show all units for region
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/units"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node units should have 3 element

    Scenario: There are no units for person in other region
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6ef50c8f-7148-4cf8-963f-d105f77ee114"
        And I send a "GET" request to "/api/v1/units"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node units should have 0 element

    Scenario: Not exists
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6ef50c8f-7148-4cf8-963f-d105f77ee114"
        And I send a "GET" request to "/api/v1/unit/0fe1d5f8-4382-4168-a7f9-cd9c728c87ee"
        Then the response status code should be 404
        And the response should be in JSON

    Scenario: Get unit
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6ef50c8f-7148-4cf8-963f-d105f77ee114"
        And I send a "GET" request to "/api/v1/unit/03e65530-57ed-471b-b4eb-fbdaed53d181"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | id     | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | name   | Kilogram                             |
            | short  | kg                                   |
            | region | ru                                   |
        And the JSON node values should have 4 element
