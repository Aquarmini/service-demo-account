<?php

namespace App\Biz\User;

use App\Core\Support\InstanceBase;
use App\Models\UserGithub;
use App\Models\UserOauth;
use App\Support\Common\Exceptions\EmptyResultException;
use App\Support\Common\Exceptions\InvalidParamsException;
use App\Sys;
use App\Thrift\Clients\GithubClient;

class Github extends InstanceBase
{
    /**
     * @desc   获取Github用户
     * @author limx
     * @param $userId
     * @param $name
     * @return UserGithub|\Phalcon\Mvc\Model\ResultInterface
     * @throws EmptyResultException
     * @throws InvalidParamsException
     */
    public function user($userId, $name)
    {
        $user = UserGithub::findFirst([
            'conditions' => 'login = ?0',
            'bind' => [$name],
        ]);

        if (empty($user)) {
            throw new EmptyResultException('用户信息不存在');
        }

        if ($user->user_id !== $userId) {
            throw new InvalidParamsException('此Github用户不属于你');
        }

        return $user;

    }

    /**
     * @desc   刷新github数据
     * @author limx
     * @param $userId
     * @param $name
     * @return bool
     */
    public function refresh($userId, $name)
    {
        $token = $this->token($userId, $name);

        $client = GithubClient::getInstance();
        $profile = $client->userProfile($name, $token);

        $user = UserGithub::findFirst($profile->id);
        if (empty($user)) {
            $user = new UserGithub();
            $user->id = $profile->id;
            $user->user_id = $userId;
            $user->login = $profile->login;
        }
        $user->avatar_url = $profile->avatar_url ?? '';
        $user->html_url = $profile->html_url ?? '';
        $user->type = $profile->type;
        $user->name = $profile->name;
        $user->company = $profile->company ?? '';
        $user->blog = $profile->blog ?? '';
        $user->location = $profile->location ?? '';
        $user->email = $profile->email ?? '';
        $user->bio = $profile->bio ?? '';
        $user->public_gists = $profile->public_gists;
        $user->public_repos = $profile->public_repos;
        $user->followers = $profile->followers;
        $user->following = $profile->following;

        if (!$user->save()) {
            return false;
        }

        return true;
    }

    /**
     * @desc   获取Token
     * @author limx
     * @param $userId
     * @param $name
     * @return string
     * @throws EmptyResultException
     */
    public function token($userId, $name)
    {
        $oauth = UserOauth::findFirst([
            'conditions' => 'type = ?0 AND name = ?1 AND user_id = ?2',
            'bind' => [Sys::OAUTH_TYPE_GITHUB, $name, $userId],
        ]);
        if (empty($oauth)) {
            throw new EmptyResultException('没有您的Github授权信息');
        }

        return $oauth->code;
    }

}

