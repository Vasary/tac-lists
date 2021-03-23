Feature:
    List

    Background:
        Given clean database
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru

    Scenario: Create
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "POST" request to "/api/v1/list" with body:
          """
          {
              "name": "list",
              "members": []
          }
          """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | name | list |

        And the JSON node id should exist
        And the JSON node items should exist
        And the JSON node members should exist
        And the JSON node created should exist
        And the JSON node updated should exist
        And the JSON nodes should be equal to:
            | members[0] | 6d912900-4d2e-4208-8c3c-dc1a4795a845 |

    Scenario: Rename
        Given list list with id 1b445a09-3ba4-4600-bdaf-c3c5cd108309
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 1b445a09-3ba4-4600-bdaf-c3c5cd108309

        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "PUT" request to "/api/v1/list" with body:
            """
            {
                "list": "1b445a09-3ba4-4600-bdaf-c3c5cd108309",
                "name": "Updated name"
            }
            """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | id         | 1b445a09-3ba4-4600-bdaf-c3c5cd108309     |
            | name       | Updated name                             |
            | members[0] | 6d912900-4d2e-4208-8c3c-dc1a4795a845     |
        And the JSON node members should have 1 element

    Scenario: Removing after tha lst person leave
        Given list my-list with id 1b445a09-3ba4-4600-bdaf-c3c5cd108309
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 1b445a09-3ba4-4600-bdaf-c3c5cd108309
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "PUT" request to "/api/v1/list/person/exclude" with body:
            """
            {
                "list": "1b445a09-3ba4-4600-bdaf-c3c5cd108309",
                "person": "6d912900-4d2e-4208-8c3c-dc1a4795a845"
            }
            """
        Then the response status code should be 200
        And the JSON nodes should be equal to:
            | list   | 1b445a09-3ba4-4600-bdaf-c3c5cd108309     |
            | person | 6d912900-4d2e-4208-8c3c-dc1a4795a845     |
            | status | 0                                        |

    Scenario: Access forbidden
        Given list my-list with id 1b445a09-3ba4-4600-bdaf-c3c5cd108309
        When I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/list/1b445a09-3ba4-4600-bdaf-c3c5cd108309"
        Then the response status code should be 403

    Scenario: Add person to list
        Given person "ebc188c6-f9d8-47d5-b558-a904a1ff7e9d" in ru
        Given list my-list with id 1b445a09-3ba4-4600-bdaf-c3c5cd108309
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 1b445a09-3ba4-4600-bdaf-c3c5cd108309

        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "PUT" request to "/api/v1/list/person/add" with body:
            """
            {
                "list": "1b445a09-3ba4-4600-bdaf-c3c5cd108309",
                "person": "ebc188c6-f9d8-47d5-b558-a904a1ff7e9d"
            }
            """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | list   | 1b445a09-3ba4-4600-bdaf-c3c5cd108309     |
            | person | ebc188c6-f9d8-47d5-b558-a904a1ff7e9d     |
            | status | 0                                        |

        When I add "X-Person-Id" header equal to "ebc188c6-f9d8-47d5-b558-a904a1ff7e9d"
        And I send a "GET" request to "/api/v1/list/1b445a09-3ba4-4600-bdaf-c3c5cd108309"
        Then the response status code should be 200
        And the JSON node members should have 2 element
