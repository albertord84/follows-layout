<?php
/*
 * MundiAPILib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace MundiAPILib\Models;

use JsonSerializable;

/**
 * Request for creating a recipient
 */
class CreateRecipientRequest implements JsonSerializable
{
    /**
     * Recipient name
     * @required
     * @var string $name public property
     */
    public $name;

    /**
     * Recipient email
     * @required
     * @var string $email public property
     */
    public $email;

    /**
     * Recipient description
     * @required
     * @var string $description public property
     */
    public $description;

    /**
     * Recipient document number
     * @required
     * @var string $document public property
     */
    public $document;

    /**
     * Recipient type
     * @required
     * @var string $type public property
     */
    public $type;

    /**
     * Bank account
     * @required
     * @maps default_bank_account
     * @var CreateBankAccountRequest $defaultBankAccount public property
     */
    public $defaultBankAccount;

    /**
     * Metadata
     * @required
     * @var array $metadata public property
     */
    public $metadata;

    /**
     * Constructor to set initial or default values of member properties
     * @param string                   $name               Initialization value for $this->name
     * @param string                   $email              Initialization value for $this->email
     * @param string                   $description        Initialization value for $this->description
     * @param string                   $document           Initialization value for $this->document
     * @param string                   $type               Initialization value for $this->type
     * @param CreateBankAccountRequest $defaultBankAccount Initialization value for $this->defaultBankAccount
     * @param array                    $metadata           Initialization value for $this->metadata
     */
    public function __construct()
    {
        if (7 == func_num_args()) {
            $this->name               = func_get_arg(0);
            $this->email              = func_get_arg(1);
            $this->description        = func_get_arg(2);
            $this->document           = func_get_arg(3);
            $this->type               = func_get_arg(4);
            $this->defaultBankAccount = func_get_arg(5);
            $this->metadata           = func_get_arg(6);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['name']                 = $this->name;
        $json['email']                = $this->email;
        $json['description']          = $this->description;
        $json['document']             = $this->document;
        $json['type']                 = $this->type;
        $json['default_bank_account'] = $this->defaultBankAccount;
        $json['metadata']             = $this->metadata;

        return $json;
    }
}
