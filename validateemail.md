# Validate Email

Used to check if the email address is already in use

**URL** : `/v1/validate-username/{q}`

**Method** : `GET`

**Auth required** : NO

**URL Params**

q=[string]

**Data Params**

NONE

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "status_code":1,
    "status_message":"Email Available"
}
```

## Success Response

**Code** : `401 UNAUTHORIZED`

**Content example**

```json
{
    "status_code":0,
    "status_message":"Email Address already taken"
}
```