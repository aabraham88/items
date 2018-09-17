## About the Exercise

The project was created using the following technologies:
- Laravel 5.6.35
- MongoDB
- JQuery 3.2
- Bootstrap 4

## Installation Steps

### Build project
```
docker-compose up -d
```

### Install Composer dependencies
```
docker-compose exec php composer install
```
### Install NPM dependencies
```
npm install
```
### Build static files
```
npm run prod
```
### Run seeder
```
docker-compose exec php php artisan db:seed
```
## API specification:
This solution involves an API REST and a Single Page Application. The API responds to the following actions:

**List items**
----
  Returns all the items in JSON data

* **URL**

  /api/v1/items

* **Method:**

  `GET`
  
*  **URL Params**

   None 

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** <br />
    ```
    {
      "data": 
        [
          {
            "id": "5b9ef86b1257c500ba179f42",
            "description": "Vel deserunt ducimus in aut ipsa adipisci a laudantium.",
            "image_link": "http://localhost/api/v1/items/5b9ef86b1257c500ba179f42/image?nocache=1537144939"
          }
        ]
    }
    ```

**Show item**
----

Returns JSON data about a single item

* **URL**

  /api/v1/items/:id

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `id=[string]`

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** <br />
    ```
    {
      "data": {
          "id": "5b9ef86b1257c500ba179f42",
          "description": "Vel deserunt ducimus in aut ipsa adipisci a laudantium.",
          "image_link": "http://localhost/api/v1/items/5b9ef86b1257c500ba179f42/image?nocache=1537144939"
      }
    }
    ```
    
**Create item**
----
Creates one item.

* **URL**

  /api/v1/items

* **Method:**

  `POST`

* **Data Params**

     **Required:**
 
   `imageFile=[File]`
   `description=[string]`

* **Success Response:**

  * **Code:** 201 <br />
    **Content:** <br />
    ```
    {
      "data":{
          "id": "5b9f13801257c500c573b112",
          "description": "Test description",
          "image_link": "http:\/\/localhost\/api\/v1\/items\/5b9f13801257c500c573b112\/image?nocache=1537151872"
      },
      "message": "Item saved correctly."
    }
    ```
 
* **Error Response:** 

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{ message : "Something bad happened" }`
    
**Edit item**
----
Edit a single item

* **URL**

  /api/v1/items/:id

* **Method:**

   `PUT`
  
*  **URL Params**

   **Required:**
 
   `id=[string]`

* **Data Params**

   **Required:**
 
   `description=[string]`

   **Optional:**
 
   `imageFile=[file]`


* **Success Response:**

  * **Code:** 202 <br />
    **Content:** <br />
    ```
    {
      "data": {
        "id": "5b9ef86c1257c500ba179f43",
        "description": "Test updated",
        "image_link": "http://localhost/api/v1/items/5b9ef86c1257c500ba179f43/image?nocache=1537153263"
      },
      "message": "Item updated correctly."
    }
    ```
 
* **Error Response:**

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{ message : "Something bad happened" }`
    
**Delete item**
----
 Delete one item

* **URL**

  /api/v1/items/:id

* **Method:**

   `DELETE`
  
*  **URL Params**

   **Required:**
 
   `id=[string]`
   
* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"message":"Item deleted correctly."}`
 
* **Error Response:**

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{ message : "Something bad happened" }`
    
 **Sort items**
----
 Change the order of the items in the list

* **URL**

  /api/v1/items/sort

* **Method:**

   `POST`
  
*  **Data Params**

   **Required:**
 
   `items=[json]`
   
* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"data":null,"message":"Items ordered  correctly."}`
 
* **Error Response:**

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{ message : "Something bad happened" }`
    
       
