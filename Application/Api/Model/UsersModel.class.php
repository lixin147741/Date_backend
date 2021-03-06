<?php
namespace Api\Model;
use Think\Model;

class UsersModel extends Model {
    protected $trueTableName  = 'users';
    //检查是否登陆
    public function checkAuth ($uid, $token) {
        $map = [
            'id' => $uid
        ];
        $data = $this->where($map)->getfield('token');
        if($data === $token)
            return true;
        else
            return false;
    }
    //取用户信息
    public function getUserInfo ($uid) {
        $map['users.id'] = $uid;
        return $this->where($map)->join("JOIN academy ON users.academy = academy.id")->field('users.id, head, signature, nickname, gender, grade,  users.academy as academy_id, academy.name as academy, qq, weixin, telephone')->find();
    }
}