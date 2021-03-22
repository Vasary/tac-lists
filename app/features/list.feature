#Feature:
#    List workflow
#
#    Background:
#        Given clean database
#
#    Scenario: Create list
#        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in "ru"
#        Given name:"my_list"
#        Given members:[]
#        Given header x-person-id with 6d912900-4d2e-4208-8c3c-dc1a4795a845
#        Then sends a "POST" request to "/api/v1/list"
#        Then response status code is 200
#        Then response has [id, name, items, members, created, updated]
#
#    Scenario: Rename list
#        Given list my_list with id 1b445a09-3ba4-4600-bdaf-c3c5cd108309
#        Given person "6d912900-4d2e-4208-8c3c-dc1a4795a845" in "ru"
#        Given add person 6d912900-4d2e-4208-8c3c-dc1a4795a845 to list 1b445a09-3ba4-4600-bdaf-c3c5cd108309
#        Given name:"my_name"
#        Given list:"1b445a09-3ba4-4600-bdaf-c3c5cd108309"
#        Given header x-person-id with 6d912900-4d2e-4208-8c3c-dc1a4795a845
#        When sends a "PUT" request to "/api/v1/list"
#        Then response status code is 200
##
##    Scenario: In list only one owner
##    Scenario: Delete list
##    Scenario: Delete list error no owner
