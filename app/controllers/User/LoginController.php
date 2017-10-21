<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\User;
use App\Support\User\Login;
use App\Support\Validation\LoginValidator;
use limx\Support\Str;

class LoginController extends Controller
{
    public function indexAction()
    {
        $data = $this->request->get();
        $validator = new LoginValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }

        $username = $this->request->get('username');
        $password = $this->request->get('password');

        $user = User::findFirst([
            'conditions' => 'username = ?0',
            'bind' => [$username]
        ]);

        if (empty($user)) {
            // 新建账号
            $user = new User();
            $user->username = $username;
            $user->password = password($password);

            if ($user->save() === false) {
                return static::error("账号新建失败！");
            }
        }

        if ($user->password === password($password)) {
            // 登录
            $token = $user->id . ":" . Str::random(32);
            Login::login($token, $user);
            return static::success([
                'token' => $token,
                'user' => $user
            ]);
        }

        return static::error("密码错误");
    }

}

