<?php

namespace App\Helpers;


class Constant
{
    const AUTH_APP_NAME = "Qawebsite";
    const IS_DELETED = 1;
    const ROLE_USER = 0;
    const ROLE_STYLIST = 1;
    const ROLE_ADMIN = 2;

    const BASIC_AUTH_NAME = "PHP_AUTH_USER";
    const BASIC_AUTH_PWD = "PHP_AUTH_PW";
    const VALUE_AUTH_NAME = "id";
    const VALUE_AUTH_PWD = "tc";
    const HTTP_AUTHORIZATION = 'HTTP_AUTHORIZATION';

    const PUBLIC_UPLOAD_STORAGE = 'public_upload';
    const SEX_MALE = 0;
    const SEX_FEMALE = 1;

    const FILTER_ALL = 0;
    const FILTER_POPULAR = 1;
    const FILTER_SELF = 2;
}
