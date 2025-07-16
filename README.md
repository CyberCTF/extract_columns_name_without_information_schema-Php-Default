# Extract MySQL 4.x Column Names Without information_schema—A Classic UNION SQLi Lab

## Description
Explore error-based column name extraction in a legacy MySQL 4.x environment. Learn manual SQLi exploitation techniques from the time before information_schema.

## Objectives
- Detect classic UNION-based SQL injection
- Determine the correct number of columns in a legacy query
- Leverage MySQL error messages for column name guessing
- Extract column names without information_schema access

## Difficulty
Intermediate

## Estimated Time
1 hour

## Prerequisites
- Basic knowledge of SQL syntax
- Familiarity with SQL injection concepts
- Experience with intercepting HTTP requests (Burp Suite, curl)

## Skills Learned
- Manual SQLi exploitation in legacy MySQL
- Schema discovery without information_schema
- Error message analysis and payload crafting

## Project Structure
- folder : build
- folder : deploy
- folder : test
- folder : docs
- file : readme.md
- file : .gitignore

## Quick Start
**Prerequisites:** Docker with Docker Compose installed

**Installation:**
```
git clone <repo-url>
cd project
docker-compose up --build
```
Access the lab at http://localhost:8080

## Issue Tracker
https://github.com/your-org/ctf-labs/issues 