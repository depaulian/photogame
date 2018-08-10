# Sign Up

Used to collect a Token for a registered User.

**URL** : `/v1/login/`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "username": "[valid username should be unique]",
    "email": "[valid email  should be unique]",
    "password": "[password in plain text]"
}
```

**Data example**

```json
{
    "username": "depaulian",
    "email": "nyumav@gmail.com",
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