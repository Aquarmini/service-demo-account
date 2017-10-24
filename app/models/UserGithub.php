<?php

namespace App\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class UserGithub extends Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=20, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=false)
     */
    public $user_id;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $login;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $avatar_url;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $html_url;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    public $type;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $company;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $blog;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    public $location;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $bio;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $public_repos;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $public_gists;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $followers;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $following;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated_at;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("account");
        $this->setSource("user_github");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserGithub[]|UserGithub|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserGithub|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_github';
    }

}
