Feature:
    Points

    Background:
        Given clean database
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru
        Given unit Kilogram as kg for ru with id 03e65530-57ed-471b-b4eb-fbdaed53d181
        Given list my list with id 4c907523-ef31-470f-b0ab-8b72bc11527e
        Given category vegetables for ru with id f4f6e817-18e9-438d-932d-e028b792292d
        Given template potato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in f4f6e817-18e9-438d-932d-e028b792292d category with id bcb5812b-a46c-43d7-9e4e-eff7666ff9bc
        Given there is a item:
            | id        | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | template  | bcb5812b-a46c-43d7-9e4e-eff7666ff9bc |
            | unit      | 03e65530-57ed-471b-b4eb-fbdaed53d181 |
            | list      | 4c907523-ef31-470f-b0ab-8b72bc11527e |
            | value     | 1                                    |

    Scenario: Get point by not list member
        Given there is a point:
            | id        | d6f956ef-b624-4ceb-bfc9-48aa4f007711 |
            | item      | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | longitude | 36.817223                            |
            | latitude  | -1.286389                            |
            | comment   | This is a comment                    |

        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/point/d6f956ef-b624-4ceb-bfc9-48aa4f007711"
        And the response status code should be 403
        And the response should be in JSON

    Scenario: Get point
        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 4c907523-ef31-470f-b0ab-8b72bc11527e
        Given there is a point:
            | id        | d6f956ef-b624-4ceb-bfc9-48aa4f007711 |
            | item      | 6d62c6a6-3368-4dad-8dbd-3227915317ff |
            | longitude | 36.817223                            |
            | latitude  | -1.286389                            |
            | comment   | This is a comment                    |

        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/point/d6f956ef-b624-4ceb-bfc9-48aa4f007711"
        And the response status code should be 200
        And the response should be in JSON
        And the JSON nodes should be equal to:
            | id        | d6f956ef-b624-4ceb-bfc9-48aa4f007711 |
            | latitude  | -1.286389                            |
            | longitude | 36.817223                            |
            | comment   | This is a comment                    |
