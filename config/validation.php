<?php
return [
    'register_user_rules'    =>     [
                                                'username'                  => 'required|unique:users',
                                                'email'                     => 'required|unique:users|email',
                                                'password'                  => 'required',
                                    ],
    'register_user_messages' =>     [
                                                'username.required'         => 'Please enter a username',
                                                'username.unique'           => 'This Username is already in use',
                                                'email.required'            => 'Please enter an email address',
                                                'username.unique'           => 'This email is already in use',
                                                'password.required'         => 'Password',
                                    ],
    'post_photo_rules'    =>        [
                                                'caption'                   => 'required',
                                                'photo'                     => 'required',
                                                'owner'                     => 'required',
                                    ],
    'post_photo_messages' =>        [
                                                'caption.required'          => 'Please enter a caption for the photo',
                                                'photo.required'            => 'Please upload the photo to save',
                                                'owner.required'            => 'Owner ID missing',
                                    ],
    'get_photos_rules'    =>        [
                                                'limit'                     => 'required',
                                                'offset'                    => 'required',
                                    ],
    'get_photos_messages' =>        [
                                                'limit.required'            => 'Please enter the limit',
                                                'offset.required'           => 'Please enter the offset',
                                    ],
    'vote_photo_rules'    =>        [
                                                'user_id'                   => 'required',
                                                'vote'                      => 'required',
                                                'photo_id'                  => 'required',
                                    ],
    'vote_photo_messages' =>        [
                                                'user_id.required'          => 'User ID missing',
                                                'vote.required'             => 'Vote missing',
                                                'photo_id.required'         => 'photo ID Missing',
                                    ],
    'view_photo_rules'    =>        [
                                                'user_id'                   => 'required',
                                                'photo_id'                  => 'required',
                                    ],
    'view_photo_messages' =>        [
                                                'user_id.required'          => 'User ID missing',
                                                'photo_id.required'         => 'photo ID Missing',
                                    ],
];