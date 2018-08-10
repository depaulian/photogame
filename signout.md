# Sign Out

Used to signout and invalidate a token till it expires

**URL** : `/vi/signout/`

**Method** : `POST`

**Auth required** : YES
**Authorisation Header** : [token]

**Data constraints**
NONE

**Data example**

```json
{
    "status_code":100,
    "status_message":"Token not provided"
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "status_code":100,
    "status_message":"User Logged Out"
}
```