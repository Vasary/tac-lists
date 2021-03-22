Feature:
    Register person

    Background:
        Given clean database

    Scenario: Person registration
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/v1/person" with body:
        """
        {
            "id": "6d912900-4d2e-4208-8c3c-dc1a4795a845",
            "region": "ru"
        }
        """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node id should exist

    Scenario: Get person
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/person"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node id should exist
        And the JSON node region should exist
        And the JSON node lists should exist


    Scenario: Duplicate person id
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
