# PROJECT


## DOCKER
```
This docker has PHP8.2, Postsgres and Redis.
Inside this folder just run: 
```
> docker-compose build 

> docker-compose up

## COMPOSER
```
You'll need to run composer install to install all dependencies for the Laravel project.
```
>docker exec -it funds_manager-web-1 sh -c "cd api && composer install"


## APPLICATION
```
All files related the application will be available in applications/api.

The application will be available in localhost:8082.

Run this command to create the migrations and seeders:
```

>docker exec -it funds_manager-web-1 sh -c "cd api && php artisan migrate:fresh --seed"

## TESTING
```
We're using PHPUnit to test a few endpoints in the application.

To run those tests, run this command:
```
>docker exec -it funds_manager-web-1 sh -c "cd api && php artisan test"

## ENDPOINTS

### List
```
List the funds.

GET | localhost:8082/api/funds

Params:
legnth |integer|min:1|max:100|
name |string|max:255|
manager |string|max:255|
year |integer|digits:4|

Example:
http://localhost:8082/api/funds?name=Littel-Frami

Response:
{
	"current_page": 1,
	"data": [
		{
			"id": 2,
			"name": "Littel-Frami",
			"start_year": 1987,
			"manager_id": 3,
			"created_at": "2023-09-08T16:50:11.000000Z",
			"updated_at": "2023-09-08T16:50:11.000000Z",
			"manager": {
				"id": 3,
				"name": "Mraz PLC",
				"created_at": "2023-09-08T16:50:11.000000Z",
				"updated_at": "2023-09-08T16:50:11.000000Z"
			},
			"aliases": [
				{
					"id": 2,
					"fund_id": 2,
					"alias": "Senger PLC",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z"
				},
				{
					"id": 3,
					"fund_id": 2,
					"alias": "Lindgren, Gusikowski and Treutel",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z"
				},
				{
					"id": 4,
					"fund_id": 2,
					"alias": "Lynch, Zemlak and Hahn",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z"
				},
				{
					"id": 5,
					"fund_id": 2,
					"alias": "Greenholt PLC",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z"
				}
			],
			"companies": [
				{
					"id": 16,
					"name": "Luettgen-Pfannerstill",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z",
					"pivot": {
						"fund_id": 2,
						"company_id": 16
					}
				},
				{
					"id": 17,
					"name": "Lockman, Marvin and Quigley",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z",
					"pivot": {
						"fund_id": 2,
						"company_id": 17
					}
				},
				{
					"id": 18,
					"name": "Corwin, Keeling and Swift",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z",
					"pivot": {
						"fund_id": 2,
						"company_id": 18
					}
				},
				{
					"id": 20,
					"name": "Bahringer Group",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z",
					"pivot": {
						"fund_id": 2,
						"company_id": 20
					}
				},
				{
					"id": 22,
					"name": "Kris PLC",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z",
					"pivot": {
						"fund_id": 2,
						"company_id": 22
					}
				},
				{
					"id": 27,
					"name": "Gislason-Emard",
					"created_at": "2023-09-08T16:50:11.000000Z",
					"updated_at": "2023-09-08T16:50:11.000000Z",
					"pivot": {
						"fund_id": 2,
						"company_id": 27
					}
				}
			]
		}
	],
	"first_page_url": "http:\/\/localhost:8082\/api\/funds?page=1",
	"from": 1,
	"last_page": 1,
	"last_page_url": "http:\/\/localhost:8082\/api\/funds?page=1",
	"links": [
		{
			"url": null,
			"label": "&laquo; Previous",
			"active": false
		},
		{
			"url": "http:\/\/localhost:8082\/api\/funds?page=1",
			"label": "1",
			"active": true
		},
		{
			"url": null,
			"label": "Next &raquo;",
			"active": false
		}
	],
	"next_page_url": null,
	"path": "http:\/\/localhost:8082\/api\/funds",
	"per_page": 10,
	"prev_page_url": null,
	"to": 1,
	"total": 1
}
```

### Show
```
Show specific fund.

GET | localhost:8082/api/funds/{FUND_ID}

Params:
FUND_ID |integer|min:1|

Example:
http://localhost:8082/api/funds/1

Response:
{
	"id": 1,
	"name": "Baumbach PLC",
	"start_year": 2001,
	"manager_id": 7,
	"created_at": "2023-09-08T07:37:02.000000Z",
	"updated_at": "2023-09-08T07:37:02.000000Z",
	"manager": {
		"id": 7,
		"name": "Jacobson, Orn and Dietrich",
		"created_at": "2023-09-08T07:37:02.000000Z",
		"updated_at": "2023-09-08T07:37:02.000000Z"
	},
	"aliases": [
		{
			"id": 1,
			"fund_id": 1,
			"alias": "Bednar-Kohler",
			"created_at": "2023-09-08T07:37:02.000000Z",
			"updated_at": "2023-09-08T07:37:02.000000Z"
		}
	],
	"companies": [
		{
			"id": 19,
			"name": "Reichel, Beer and Barrows",
			"created_at": "2023-09-08T07:37:02.000000Z",
			"updated_at": "2023-09-08T07:37:02.000000Z",
			"pivot": {
				"fund_id": 1,
				"company_id": 19
			}
		},
		{
			"id": 28,
			"name": "Gleichner Inc",
			"created_at": "2023-09-08T07:37:02.000000Z",
			"updated_at": "2023-09-08T07:37:02.000000Z",
			"pivot": {
				"fund_id": 1,
				"company_id": 28
			}
		}
	]
}
```

### DESTROY
```
Delete specific fund.

DELETE | localhost:8082/api/funds/{FUND_ID}

Params:
FUND_ID |integer|min:1|

Example:
http://localhost:8082/api/funds/1

Response:
code 204
```


### STORE
```
Update specific fund.

POST | localhost:8082/api/funds

Payload:
{
	"name": "Test",
	"start_year": "1992",
	"manager": "Paul and John",
	"alias": ["Alias1", "Alias2", "Alias3"],
	"companies": ["Cp1", "Cp2", "Cp3"]
}

Example:
http://localhost:8082/api/funds

Response:
{
	"name": "Test",
	"start_year": "1992",
	"manager_id": 20,
	"updated_at": "2023-09-08T07:07:30.000000Z",
	"created_at": "2023-09-08T07:07:30.000000Z",
	"id": 30,
	"manager": {
		"id": 20,
		"name": "Paul and John",
		"created_at": "2023-09-08T07:07:30.000000Z",
		"updated_at": "2023-09-08T07:07:30.000000Z"
	},
	"aliases": [
		{
			"id": 70,
			"fund_id": 30,
			"alias": "Alias1",
			"created_at": "2023-09-08T07:07:30.000000Z",
			"updated_at": "2023-09-08T07:07:30.000000Z"
		},
		{
			"id": 71,
			"fund_id": 30,
			"alias": "Alias2",
			"created_at": "2023-09-08T07:07:30.000000Z",
			"updated_at": "2023-09-08T07:07:30.000000Z"
		},
		{
			"id": 72,
			"fund_id": 30,
			"alias": "Alias3",
			"created_at": "2023-09-08T07:07:30.000000Z",
			"updated_at": "2023-09-08T07:07:30.000000Z"
		}
	],
	"companies": [
		{
			"id": 34,
			"name": "Cp1",
			"created_at": "2023-09-08T07:07:30.000000Z",
			"updated_at": "2023-09-08T07:07:30.000000Z",
			"pivot": {
				"fund_id": 30,
				"company_id": 34
			}
		},
		{
			"id": 35,
			"name": "Cp2",
			"created_at": "2023-09-08T07:07:30.000000Z",
			"updated_at": "2023-09-08T07:07:30.000000Z",
			"pivot": {
				"fund_id": 30,
				"company_id": 35
			}
		},
		{
			"id": 36,
			"name": "Cp3",
			"created_at": "2023-09-08T07:07:30.000000Z",
			"updated_at": "2023-09-08T07:07:30.000000Z",
			"pivot": {
				"fund_id": 30,
				"company_id": 36
			}
		}
	]
}
```


### UPDATE
```
Update specific fund.

PUT | localhost:8082/api/funds

Payload:
{
	"name": "Test",
	"start_year": "1992",
	"manager": "Paul and John",
	"alias": ["Alias1", "Alias2", "Alias3"],
	"companies": ["Cp1", "Cp4"]
}

Example:
http://localhost:8082/api/funds

Response:
{
	"id": 2,
	"name": "Test",
	"start_year": "1992",
	"manager_id": 26,
	"created_at": "2023-09-08T06:33:38.000000Z",
	"updated_at": "2023-09-08T07:25:29.000000Z",
	"manager": {
		"id": 26,
		"name": "Paul and John",
		"created_at": "2023-09-08T07:29:49.000000Z",
		"updated_at": "2023-09-08T07:29:49.000000Z"
	},
	"aliases": [
		{
			"id": 86,
			"fund_id": 2,
			"alias": "Alias1",
			"created_at": "2023-09-08T07:29:49.000000Z",
			"updated_at": "2023-09-08T07:29:49.000000Z"
		},
		{
			"id": 87,
			"fund_id": 2,
			"alias": "Alias2",
			"created_at": "2023-09-08T07:29:49.000000Z",
			"updated_at": "2023-09-08T07:29:49.000000Z"
		},
		{
			"id": 88,
			"fund_id": 2,
			"alias": "Alias3",
			"created_at": "2023-09-08T07:29:49.000000Z",
			"updated_at": "2023-09-08T07:29:49.000000Z"
		}
	],
	"companies": [
		{
			"id": 42,
			"name": "Cp1",
			"created_at": "2023-09-08T07:29:49.000000Z",
			"updated_at": "2023-09-08T07:29:49.000000Z",
			"pivot": {
				"fund_id": 2,
				"company_id": 42
			}
		},
		{
			"id": 43,
			"name": "Cp4",
			"created_at": "2023-09-08T07:29:49.000000Z",
			"updated_at": "2023-09-08T07:29:49.000000Z",
			"pivot": {
				"fund_id": 2,
				"company_id": 43
			}
		}
	]
}
```