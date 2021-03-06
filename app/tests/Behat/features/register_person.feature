Feature:
    Person

    Background:
        Given clean database

    Scenario: Registration
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/v1/person" with body:
        """
        {
            "id": "6d912900-4d2e-4208-8c3c-dc1a4795a845",
            "region": "ru"
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | id | 6d912900-4d2e-4208-8c3c-dc1a4795a845 |

    Scenario: Get
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/person"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | id | 6d912900-4d2e-4208-8c3c-dc1a4795a845 |
            | region | ru |
        And the JSON node lists should exist
        And the JSON node lists should have 0 element

    Scenario: Duplicate
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in "ru"
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/v1/person" with body:
        """
        {
            "id": "6d912900-4d2e-4208-8c3c-dc1a4795a845",
            "region": "ru"
        }
        """
        Then the response status code should be 409
