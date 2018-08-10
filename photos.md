# Photos

Returns a list of photos

**URL** : `/v1/photos`

**Method** : `GET`

**Auth required** : NO

**URL Params**

sorting=[number]
limit=[number]
offset=[number]

**Data Params**

NONE

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "status":  "Success",
    "status_code":  100,
    "result":   "[list of photos from]",
}
```
**result**
```json
{
    "id":  "Success",
    "caption":  100,
    "photo":   "[string containing url of photo]",
    "category_id":   "[number]",
    "category":   "[category photo belongs to]",
    "description":   "[description of photo]",
    "owner_id":   "[id of owner of photo]",
    "username":   "[username of owner of photo]",
    "location":   "[location photo was taken",
    "time_taken":   "[time photo was taken (Y-m-d h:i:s)]",
    "vote_up":   "[count of vote ups]",
    "vote_down":   "[count of vote downs]",
    "views":   "[count of views]",
    "vote_score":   "[vote score generated using Lower bound of Wilson score confidence interval for a Bernoulli parameter]",
}
```

## Success Response

**Code** : `401 UNAUTHORIZED`

**Content example**

```json
{
    "status":"Error",
    "status_code":102,
    "message":"could not verify token"
}
```