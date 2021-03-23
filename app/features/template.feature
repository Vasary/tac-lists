Feature:
    Template

    Background:
        Given clean database
        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in ru
        Given category vegetables for ru with id a1308cf5-985c-44aa-bb99-7fcf2cfd9940

    Scenario: Create
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "POST" request to "/api/v1/template" with body:
          """
          {
              "name": "potato",
              "category": "a1308cf5-985c-44aa-bb99-7fcf2cfd9940",
              "icon": "fa-default",
              "images": ["https://tac.localhost/1.png"]
          }
          """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node id should exist
        And the JSON node created should exist
        And the JSON node updated should exist
        And the JSON node id should exist
        And the JSON node common should be false
        And the JSON node images should have 1 element
        And the JSON nodes should be equal to:
            | name      | potato                                |
            | region    | ru                                    |
            | category  | a1308cf5-985c-44aa-bb99-7fcf2cfd9940  |
            | author    | 6d912900-4d2e-4208-8c3c-dc1a4795a845  |
            | icon      | fa-default                            |

    Scenario: Update
        Given category vegetables for ru with id f4d7ac69-e528-43ee-b165-ae2539484ea2
        Given template tomato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in a1308cf5-985c-44aa-bb99-7fcf2cfd9940 category with id 7049c634-05f0-4f7a-bad1-accffe0ef634
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "PUT" request to "/api/v1/template" with body:
          """
          {
              "id": "7049c634-05f0-4f7a-bad1-accffe0ef634",
              "name": "potato",
              "category": "f4d7ac69-e528-43ee-b165-ae2539484ea2",
              "icon": "fa-milk",
              "images": ["https://tac.localhost/1.png", "https://tac.localhost/2.png"]
          }
          """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node id should exist
        And the JSON node created should exist
        And the JSON node updated should exist
        And the JSON node id should exist
        And the JSON node common should be false
        And the JSON node images should have 2 element
        And the JSON nodes should be equal to:
            | name      | potato                                |
            | region    | ru                                    |
            | category  | f4d7ac69-e528-43ee-b165-ae2539484ea2  |
            | author    | 6d912900-4d2e-4208-8c3c-dc1a4795a845  |
            | icon      | fa-milk                               |

    Scenario: All
        Given template tomato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in a1308cf5-985c-44aa-bb99-7fcf2cfd9940 category
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/templates"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node templates should exist
        And the JSON node templates should have 1 element

    Scenario: In different regions
        Given person "e8fd3892-0b55-4dc1-a328-5dd6bded97af" in az
        Given template tomato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in a1308cf5-985c-44aa-bb99-7fcf2cfd9940 category
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "e8fd3892-0b55-4dc1-a328-5dd6bded97af"
        And I send a "GET" request to "/api/v1/templates"
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node templates should exist
        And the JSON node templates should have 0 element

    Scenario: Delete own
        Given template tomato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in a1308cf5-985c-44aa-bb99-7fcf2cfd9940 category with id 7049c634-05f0-4f7a-bad1-accffe0ef634
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "DELETE" request to "/api/v1/template/7049c634-05f0-4f7a-bad1-accffe0ef634"
        Then the response status code should be 200
        And the JSON nodes should be equal to:
            | id      | 7049c634-05f0-4f7a-bad1-accffe0ef634 |
            | code    | 0                                    |

    Scenario: Delete not own
        Given person "65bed4c8-a5dc-4600-b805-4ee11b130aca" in ru
        Given template tomato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in a1308cf5-985c-44aa-bb99-7fcf2cfd9940 category with id 7049c634-05f0-4f7a-bad1-accffe0ef634
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "65bed4c8-a5dc-4600-b805-4ee11b130aca"
        And I send a "DELETE" request to "/api/v1/template/7049c634-05f0-4f7a-bad1-accffe0ef634"
        Then the response status code should be 403

    Scenario: Get one template
        Given template tomato created by 6d912900-4d2e-4208-8c3c-dc1a4795a845 in a1308cf5-985c-44aa-bb99-7fcf2cfd9940 category with id 7049c634-05f0-4f7a-bad1-accffe0ef634
        When I add "Content-Type" header equal to "application/json"
        And I add "X-Person-Id" header equal to "6d912900-4d2e-4208-8c3c-dc1a4795a845"
        And I send a "GET" request to "/api/v1/template/7049c634-05f0-4f7a-bad1-accffe0ef634"
        Then the response status code should be 200
        And the JSON node created should exist
        And the JSON node updated should exist
        And the JSON node images should exist
        And the JSON node common should exist
        And the JSON node icon should exist
        And the JSON node common should be false
        And the JSON node images should have 0 element
        And the JSON nodes should be equal to:
            | id        | 7049c634-05f0-4f7a-bad1-accffe0ef634 |
            | name      | tomato                               |
            | region    | ru                                   |
            | category  | a1308cf5-985c-44aa-bb99-7fcf2cfd9940 |
            | author    | 6d912900-4d2e-4208-8c3c-dc1a4795a845 |
