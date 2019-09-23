---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_20bd09fb1dffcb83de1002a798c46015 -->
## Owner rating page
Host can give ratings to the users after checkout of the user.

> Example request:

```bash
curl -X GET -G "http://localhost/dashboard/own?status=dicta&owner_id=consequatur" \
    -H "Content-Type: application/json" \
    -d '{"user_id":11,"cnt":1}'

```

```javascript
const url = new URL("http://localhost/dashboard/own");

    let params = {
            "status": "dicta",
            "owner_id": "consequatur",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 11,
    "cnt": 1
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET dashboard/own`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | integer |  required  | id of the user.
    cnt | integer |  required  | count of the checkouts of that hosts.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    status |  optional  | string required staus of check out.
    owner_id |  optional  | int required id of the owner.

<!-- END_20bd09fb1dffcb83de1002a798c46015 -->

<!-- START_82a7a321ae283a102c9443899989d7fb -->
## dashboard/advertise/{id}/{id1}/{id2}/{id3}
> Example request:

```bash
curl -X POST "http://localhost/dashboard/advertise/1/1/1/1" 
```

```javascript
const url = new URL("http://localhost/dashboard/advertise/1/1/1/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST dashboard/advertise/{id}/{id1}/{id2}/{id3}`


<!-- END_82a7a321ae283a102c9443899989d7fb -->

<!-- START_7fc46415b7f3a218b7c64bb4afe72faf -->
## Confirm Room
Host can confirm room booking of the users

> Example request:

```bash
curl -X POST "http://localhost/dashboard/confirmroom/1/1?id=laudantium&id1=ut&user_id=voluptatem&user_name=dolor&guest_id=quod&from_date=ipsam&to_date=at&status=quasi" 
```

```javascript
const url = new URL("http://localhost/dashboard/confirmroom/1/1");

    let params = {
            "id": "laudantium",
            "id1": "ut",
            "user_id": "voluptatem",
            "user_name": "dolor",
            "guest_id": "quod",
            "from_date": "ipsam",
            "to_date": "at",
            "status": "quasi",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST dashboard/confirmroom/{id}/{id1}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | int required id of the room.
    id1 |  optional  | int required id of the request.
    user_id |  optional  | int optional id of the user
    user_name |  optional  | int optional name of the user
    guest_id |  optional  | int optional id of the guest
    from_date |  optional  | date optional date of booking start
    to_date |  optional  | date optional date of booking ends
    status |  optional  | string optional status of booking of the user

<!-- END_7fc46415b7f3a218b7c64bb4afe72faf -->

<!-- START_9c4e1ad7801e4221385b38ab020d5033 -->
## dashboard/checkout/{id}
> Example request:

```bash
curl -X POST "http://localhost/dashboard/checkout/1" 
```

```javascript
const url = new URL("http://localhost/dashboard/checkout/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST dashboard/checkout/{id}`


<!-- END_9c4e1ad7801e4221385b38ab020d5033 -->

<!-- START_c231d1be96abba83e7387fdbe4b25745 -->
## Cancel room
Host can cancel room booking of the users

> Example request:

```bash
curl -X POST "http://localhost/dashboard/cancelroom/1/1?id=dolorum&id1=occaecati&from_date=est&hostid=eaque&to_date=incidunt&status=excepturi" 
```

```javascript
const url = new URL("http://localhost/dashboard/cancelroom/1/1");

    let params = {
            "id": "dolorum",
            "id1": "occaecati",
            "from_date": "est",
            "hostid": "eaque",
            "to_date": "incidunt",
            "status": "excepturi",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST dashboard/cancelroom/{id}/{id1}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | int required id of the room.
    id1 |  optional  | int required id of the request.
    from_date |  optional  | date optional date of booking start
    hostid |  optional  | id of hosts
    to_date |  optional  | date optional date of booking ends
    status |  optional  | string optional status of booking of the user

<!-- END_c231d1be96abba83e7387fdbe4b25745 -->

<!-- START_30059a09ef3f0284c40e4d06962ce08d -->
## Dashboard
Show the application dashboard.

> Example request:

```bash
curl -X GET -G "http://localhost/dashboard" 
```

```javascript
const url = new URL("http://localhost/dashboard");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET dashboard`


<!-- END_30059a09ef3f0284c40e4d06962ce08d -->

<!-- START_59784102d9700657ce638c28b6512ece -->
## Request Room
Host can confirm room booking of the users

> Example request:

```bash
curl -X GET -G "http://localhost/dashboard/requestroom?id=aut&id1=qui&user_id=deleniti&user_name=nesciunt&guest_id=molestiae&from_date=sed&to_date=aut&status=minus" 
```

```javascript
const url = new URL("http://localhost/dashboard/requestroom");

    let params = {
            "id": "aut",
            "id1": "qui",
            "user_id": "deleniti",
            "user_name": "nesciunt",
            "guest_id": "molestiae",
            "from_date": "sed",
            "to_date": "aut",
            "status": "minus",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET dashboard/requestroom`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | int required id of the room.
    id1 |  optional  | int required id of the request.
    user_id |  optional  | int optional id of the user
    user_name |  optional  | int optional name of the user
    guest_id |  optional  | int optional id of the guest
    from_date |  optional  | date optional date of booking start
    to_date |  optional  | date optional date of booking ends
    status |  optional  | string optional status of booking of the user

<!-- END_59784102d9700657ce638c28b6512ece -->

<!-- START_e01c7d57bbb66bb818d4eb3cbd249440 -->
## Occupied room
Showing occupied room page with the users who occupied host rooms at present

> Example request:

```bash
curl -X GET -G "http://localhost/dashboard/occupiedroom" \
    -H "Content-Type: application/json" \
    -d '{"user_id":20}'

```

```javascript
const url = new URL("http://localhost/dashboard/occupiedroom");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 20
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET dashboard/occupiedroom`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | integer |  required  | id of the host.

<!-- END_e01c7d57bbb66bb818d4eb3cbd249440 -->

<!-- START_a48559600b03f7367bb1fd51b81d3ad5 -->
## Useroom
Showing the room currently user is using. After checkout, he can give rating.

> Example request:

```bash
curl -X GET -G "http://localhost/dashboard/usingroom?requested_by_id=eum&status=omnis" \
    -H "Content-Type: application/json" \
    -d '{"user_id":12,"cc":18,"cc1":20,"cnt":13,"todayDate":"consectetur"}'

```

```javascript
const url = new URL("http://localhost/dashboard/usingroom");

    let params = {
            "requested_by_id": "eum",
            "status": "omnis",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 12,
    "cc": 18,
    "cc1": 20,
    "cnt": 13,
    "todayDate": "consectetur"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET dashboard/usingroom`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | integer |  required  | id of the user.
    cc | integer |  required  | count of the confirm requests.
    cc1 | integer |  required  | count of the checkouts
    cnt | integer |  required  | sum of cc and cc1
    todayDate | date |  required  | date of today
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    requested_by_id |  optional  | int required id of the user.
    status |  optional  | string required status of the request.

<!-- END_a48559600b03f7367bb1fd51b81d3ad5 -->

<!-- START_a9f173411754e129a30cabca26281c79 -->
## dashboard/occupiedroom/pdf
> Example request:

```bash
curl -X GET -G "http://localhost/dashboard/occupiedroom/pdf" 
```

```javascript
const url = new URL("http://localhost/dashboard/occupiedroom/pdf");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET dashboard/occupiedroom/pdf`


<!-- END_a9f173411754e129a30cabca26281c79 -->

<!-- START_75f65c5bb88439a5ed2b10b1b369a04c -->
## Cancel Wanting rooms
User can cancel requested room

> Example request:

```bash
curl -X POST "http://localhost/dashboard/cancelwantingroom/1?id=aut&requested_to_date=dolor&requested_from_date=iste" 
```

```javascript
const url = new URL("http://localhost/dashboard/cancelwantingroom/1");

    let params = {
            "id": "aut",
            "requested_to_date": "dolor",
            "requested_from_date": "iste",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST dashboard/cancelwantingroom/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | int required id of the room.
    requested_to_date |  optional  | date required date of checkout.
    requested_from_date |  optional  | date required date of the entry.

<!-- END_75f65c5bb88439a5ed2b10b1b369a04c -->

<!-- START_a2dc297870b2821e55fa4d702afcd57f -->
## Wanting room
Showing users requested rooms

> Example request:

```bash
curl -X GET -G "http://localhost/dashboard/wantingroom?hostid=voluptatum" \
    -H "Content-Type: application/json" \
    -d '{"user_id":5}'

```

```javascript
const url = new URL("http://localhost/dashboard/wantingroom");

    let params = {
            "hostid": "voluptatum",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 5
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET dashboard/wantingroom`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | integer |  required  | id of the user.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    hostid |  optional  | int required id of the host.

<!-- END_a2dc297870b2821e55fa4d702afcd57f -->

<!-- START_353d99a365064dd3d5214f629a80a6dd -->
## Notification
showing notifications for the user account

> Example request:

```bash
curl -X GET -G "http://localhost/notify?guest_id=sint&requested_from_date=eos" \
    -H "Content-Type: application/json" \
    -d '{"user_id":13}'

```

```javascript
const url = new URL("http://localhost/notify");

    let params = {
            "guest_id": "sint",
            "requested_from_date": "eos",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 13
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET notify`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | integer |  required  | id of the user.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    guest_id |  optional  | date required date of user.
    requested_from_date |  optional  | date required date of the entry.

<!-- END_353d99a365064dd3d5214f629a80a6dd -->


