<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
  public $username;
  public $password;
  public $email;
  public $confirmPassword;
  public $role;

  public function rules()
  {
      return [
          // username and password are both required
          [['username', 'password', 'confirmPassword', 'email'], 'required'],
          // rememberMe must be a boolean value
          [['email'], 'email'],
          // password is validated by validatePassword()
          ['confirmPassword', 'compare', 'compareAttribute' => 'password'],
      ];
  }

  public function signup(){
    $user = new User();
    $user->username = $this->username;
    $user->password = $this->password;
    $user->email = $this->email;
    if($user->save()){
      return $user;
    }
    return false;
  }
}
