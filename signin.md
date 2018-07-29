# Login

Used to collect a Token for a registered User.

**URL** : `/vi/login/`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "username": "[valid username]",
    "password": "[password in plain text]"
}
```

**Data example**

```json
{
    "username": "depaulian",
    "password": "abcd1234"
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "user": "[An object of the user data with an access token]",
    "status_code":100,
    "status":"Success"
}
```

## Error Response

**Condition** : If 'username' and 'password' combination is wrong.

**Code** : `401 BAD REQUEST`

**Content** :

```json
{
    "status":"Error",
    "status_code":102,
    "message":"Invalid Username and/or password"
}
```