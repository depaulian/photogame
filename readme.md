# PhotoGame TM Backend Service

This backend service provides programmatic access to PhotoGame App. It provides functionality for login, signup, viewing photos, uploading
photos and voting photos.

## Open Endpoints

Endpoints for user authentication and Onboarding. These endpoints require no authetication/access token

* [Sign In] : `POST /v1/signin`
* [Sign Up](signup.md) : `POST /v1/signup`
* [Validate Username](validateusername.md) : `GET /validate-username/{q}`
* [Validate Email](validateemail.md) : `GET /validate-useremailname/{q}`

## Photo End Points

These are endpoints for voting, posting and viewing photos and signing out. These require you to be authenticated.

* [Sign Out](signout.md) : `POST /v1/signout`
* [Post Photo](postphoto.md) : `POST /v1/post-photo`
* [photos](photos.md) : `GET /v1/photos`
* [photo](photo.md) : `GET /v1/photos/{id}`
* [Vote Photo](validateusername.md) : `POST /vote-photo/{q}`
* [View Photo](validateemail.md) : `POST /view-photo/{q}`

# PhotoGame TM Backend Service