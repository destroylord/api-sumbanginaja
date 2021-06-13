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
    "status": true,
    "message": "Logged in!",
    "data": {
        "id": 12,
        "name": "apin",
        "email": "sinchan45@gmail.com",
        "email_verified_at": null,
        "profile_users": null,
        "no_handphone": null,
        "address": null,
        "created_at": "2021-06-12T19:06:55.000000Z",
        "updated_at": "2021-06-12T19:06:55.000000Z",
        "token": "1|ySYWzmdcs2qFaOYGfUrIla8sToZVABUfTR24z5bY"
    }
}
```

#### Register

url : `api/register`

Endpoint : `POST`

```shell
{
    "status": true,
    "message": "Account Created Successfully!"
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

#### Foods

url : `api/v1/foods/1/show`

Endpoint : `GET`

```shell
{
    "message": "Retrieved Successfully!",
    "data": {
        "id": 1,
        "name": "Derrick Donnelly",
        "images": "https://via.placeholder.com/640x480.png/009911?text=eos",
        "descriptions": "Nihil doloribus quibusdam rem. At autem placeat atque et maiores. Id a omnis voluptas voluptatem temporibus non autem. Animi neque adipisci cumque quidem velit maiores quia.",
        "payback_time": "15:39:39",
        "created_at": "2021-06-12T18:08:59.000000Z",
        "updated_at": "2021-06-12T18:08:59.000000Z"
    }
}
```

#### Foods

url : `api/v1/foods/9`

Endpoint : `DELETE`

```shell
{
    'message' => 'Community deleted'
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

url : `api/v1/community/create`

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

#### Community

url : `api/v1/community/1/show`

Endpoint : `GET`

```shell
{
    "message": "Retrieved Successfully!",
    "data": {
        "id": 1,
        "name": "Jordyn Corkery",
        "images": "https://via.placeholder.com/640x480.png/009911?text=ullam",
        "banners": "https://via.placeholder.com/640x480.png/008800?text=eum",
        "locations": "393 Ruecker Lock Suite 013\nNorth Reuben, MA 09834",
        "descriptions": "Optio quis voluptatem eos rerum quam et. Vel fugiat qui enim aut soluta. Molestiae commodi sunt animi explicabo neque.",
        "created_at": "2021-06-12T18:09:00.000000Z",
        "updated_at": "2021-06-12T18:09:00.000000Z"
    }
}
```

#### Community

url : `api/v1/community/{id}`

Endpoint : `FELETE`

```shell
{
    'message' => 'Community deleted'
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