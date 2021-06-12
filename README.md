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

```shell
{
    'status_code' => 200,
    'token'       => $token
}
```

#### Register

url : `api/register`

Endpoint : `POST`

```shell
{
    'staatus_code' => 201,
    'message'      => 'user registered successfully!'
}
```

#### Food

url : `api/v1/foods`

Endpoint : `GET`

```shell
{
    'staatus_code' => 200,
    'message'      => 'show data food'
    'data'         => $data
}
```

#### Foods

url : `api/food/create`

Endpoint : `POST`

```shell
{
    "success": true,
    "message": "Add Data successfully!",
    "data": {
        "name": "dila",
        "images": "public/foods/1623412641.png",
        "descriptions": "ajksdhajksdhkjahsdjkhjakshd",
        "payback_time": "05:05:05",
        "updated_at": "2021-06-11T11:57:21.000000Z",
        "created_at": "2021-06-11T11:57:21.000000Z",
        "id": 13
    }
}
```

#### Community

url : `api/v1/communities`

Endpoint : `GET`

```shell
{
    'staatus_code' => 200,
    'message'      => 'success show data'
    'data'         => $data
}
```

#### Community

url : `v1/community/create`

Endpoint : `POST`

```shell
{
    "success": true,
    "message": "Created successfully!",
    "data": {
        "name": "iqbual",
        "locations": "tamansari",
        "descriptions": "alkshdajksdkhaskdhkjahsjk",
        "images": "public/communities/images1623413532.png",
        "banners": "public/communities/banners1623413532.png",
        "updated_at": "2021-06-11T12:12:12.000000Z",
        "created_at": "2021-06-11T12:12:12.000000Z",
        "id": 18
    }
}
```

#### Event

url : `api/v1/events`

Endpoint : `GET`

```shell
{
    "message": "show data event",
    "data": [
        {
            "id": 1,
            "name": "lomba bulatng",
            "images": "public/events/1623507120.png",
            "locations": "jln.blindungan",
            "descriptions": "eqwkjelwq;jkeopwqeiuyqiwy",
            "created_at": "2021-06-12T14:12:00.000000Z",
            "updated_at": "2021-06-12T14:12:00.000000Z"
        }
    ]
}
```

#### Event

url : `v1/Event/create`

Endpoint : `POST`

```shell
{
    "success": true,
    "message": "Add Data successfully!",
    "data": {
        "name": "lomba bulatng",
        "locations": "jln.blindungan",
        "descriptions": "eqwkjelwq;jkeopwqeiuyqiwy",
        "images": "public/events/1623507120.png",
        "updated_at": "2021-06-12T14:12:00.000000Z",
        "created_at": "2021-06-12T14:12:00.000000Z",
        "id": 1
    }
}
```

------

Copyright by Pancakara 2021