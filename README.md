### Introduction

Api ini dibuat untuk perkembangan aplikasi sumbangin aja yang dibuat oleh :

- Fahmi Dafrin Maulana (Backend)
- Ibnu Batutah (Android Backend)
- Sang Bintang Putra Alam (Android Frontend)

### Status Code

return untuk mengikuti status code dibawah ini : 

| Status Code | Description             |
| ----------- | ----------------------- |
| 200         | `OK`                    |
| 201         | `CREATED`               |
| 400         | `BAD REQUEST`           |
| 404         | `NOT FOUND`             |
| 500         | `INTERNAL SERVER ERROR` |



### Authentication

authentication Login and Register

#### Login

url : `api/login`

Endpoint : `POST`

```json
{
	 'status_code' => 200,
     'token'       => $token
}
```

#### Register

url : `api/register`

Endpoint : `POST`

```json
{
    'staatus_code' => 201,
	'message'      => 'user registered successfully!'
}
```



------

Copyright by Pancakara 2021