# PHP Backend Developer Test Project
## Overview
This test project focuses on implementing GraphQL mutations and queries using API Platform in a Symfony environment. The project includes Docker setup with FrankenPHP and uses Doctrine for database management.

## Project Setup
The project comes with a pre-configured environment including:
- Docker & FrankenPHP
- Symfony Framework
- API Platform
- GraphQL
- Doctrine ORM
- PostgreSQL

## Assignment Details

### Task Description
You need to implement four GraphQL endpoints with functional tests

#### Mutations:
1. Create new trades
2. Create new transactions

Trade creation should be done with an auto-generated trade number (10 characters, alphanumeric). Add validations if needed. Implement saving trades and transactions to the database.

#### Queries:
1. Fetch collection of trades
2. Fetch collection of transactions

Exclude soft deleted trades and transactions from response.

## General Requirements
- All endpoints must be GraphQL-based (not REST)
- Implement proper input validation

### Time Limit
You have 7 days to complete the test.
Maximum time allocation: 3-4 hours
If not completed within the time limit, submit the work completed so far

## Useful Resources
https://graphql.org/learn/queries/
https://graphql.org/learn/mutations/
https://api-platform.com/docs/core/graphql/


## Questions
Feel free to ask any questions for clarification during the test.


## Submission

To hand in the project, please create a repository in a place of your choosing and invite mvanloon@afsgroup.nl, fandrade@afsgroup.nl and aromanchenko@afsgroup.nl

Also add:
- Brief explanation of choices made in development, you are expected to be able to explain in detail during the interview.

Good luck!