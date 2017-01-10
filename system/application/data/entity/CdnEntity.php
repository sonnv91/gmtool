<?php

require_once "base/BaseEntity.php";
class CdnEntity extends BaseEntity{

    public $version;

    public $url;

    public $mandatory = true;

    public $client_type;

}