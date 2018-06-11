<?php
/**
 * Created by PhpStorm
 * PROJECT: 加密类
 * User: Doing<vip.dulin@gmial.com>
 * Date: 2018/5/25/16:08
 * Desc:hash加密类
 */


namespace password;

class Password {
//PASSWORD_BCRYPT - 使用 CRYPT_BLOWFISH 算法创建散列。 这会产生兼容使用 "$2y$" 的 crypt()。 结果将会是
//60 个字符的字符串， 或者在失败时返回 FALSE。
    const HASH = PASSWORD_BCRYPT;
    const COST = 12;

    /**加密
     * @param $password [加密前密码 不能超过72个字符]
     * @return bool|string[加密后密码]
     */
	public static function hash($password){
		$passwordHash = password_hash($password, self::HASH, ['cost'=>self::COST]);
		if(password_needs_rehash($passwordHash, self::HASH, ['cost'=>self::COST])){
			$passwordHash = self::hash($password);
		}
		return $passwordHash;
	}

    /**方法hash的密码匹配
     * @param $password [原始密码]
     * @param $passwordHash [加密后的密码]
     * @return bool [true(匹配成功),false(匹配失败)]
     */
	public static function verify($password, $passwordHash){
		if(password_verify($password, $passwordHash)) return true;
		return false;
	}
}