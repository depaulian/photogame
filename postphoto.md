# Post Photo

Used to post a photo and its atributes to the remote server.

**URL** : `/v1/post-photo/`

**Method** : `POST`

**Auth required** : YES

**Data constraints**

```json
{
    "caption": "[string required]",
    "photo": "[base64 string of the photo]",
    "description": "[string (optional)]",
    "category": "[number]",
    "owner": "[number]",
    "location": "[string]",
    "time_taken": "[Date Time]",
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "status": "success",
    "status_code": 100,
    "result": "[Array containing attributes of photo saved]"
}
```

## Error Response

**Code** : `401 UNAUTHORIZED`

**Content example**

```json
{
    "status": "Error",
    "status_code": 103,
    "message":"An error occured while saving image"
}
```

```json
{
    "status": "Error",
    "status_code": 101,
    "message":"Could not verify token"
}
```