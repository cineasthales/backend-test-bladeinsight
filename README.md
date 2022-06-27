# Back-end Test Bladeinsight 

Developed by Thales Cezar Castro using PHP.

# Requirements
- PHP v8.1

# How to run
1. In the terminal, go to the desired directory using the command `cd`
2. Clone this repository
```bash
git clone https://github.com/cineasthales/backend-test-bladeinsight

```
3. Run the server
```bash
php -S localhost:8080
```

# Routes
## GET /addresses
### Return
A JSON-formatted array containing all the data in the CSV file.

## POST /addresses
### Params
- address: a 4-sized array containg all the data to insert into the CSV file.
### Return
A boolean value that indicates if the data was successfully inserted.

## GET /addresses?id=value
### Return
A JSON-formatted array containing all the data in the CSV file related to the id.

## PUT /addresses?id=value
### Params
- address: a 3-sized array containg all the data to update in the CSV file related to the id.
### Return
A boolean value that indicates if the data was successfully updated.

## DELETE /addresses?id=value
### Return
A boolean value that indicates if the data was successfully deleted from the CSV file.
