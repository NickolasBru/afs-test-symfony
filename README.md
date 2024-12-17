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

## Decision making

For this test, I used the repository pattern with interfaces and a Validator for the field requirements.
I also applied a global trait for not fetching soft-deleted data.
And I did take the liberty to create a new migration, adding a sequence, and setting the id fields to be auto-incrementing
