Feature:
    Register person

    Scenario: Person registration
        Given clean database
        Given the parameter "id" with "6d912900-4d2e-4208-8c3c-dc1a4795a845" as "string"
        Given the parameter "region" with "RU" as "string"
        When sends a "POST" request to "/api/v1/person"
        Then the response status code is 200
        Then the response is valid json
        Then the response json has "id"
        Then the response json has "region"

    Scenario: Get person
        Given clear parameters
        Given the "x-person-id" with "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        When sends a "GET" request to "/api/v1/person"
        Then the response is valid json
        Then the response json "id" equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        Then the response json "region" equal to "ru"

    Scenario: Duplicate person id
        Given the parameter "id" with "6d912900-4d2e-4208-8c3c-dc1a4795a845" as "string"
        Given the parameter "region" with "RU" as "string"
        When sends a "POST" request to "/api/v1/person"
        Then the response status code is 409
