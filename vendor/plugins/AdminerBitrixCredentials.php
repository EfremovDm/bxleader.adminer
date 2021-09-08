<?php

class AdminerBitrixCredentials {

	private $host, $login, $database, $password;

	public function __construct($arConnection) {

		$_SESSION['pwds']['server'][$arConnection['host']][$arConnection['login']] = $arConnection['password'];
		$_SESSION['db']['server'][$arConnection['host']][$arConnection['login']][$arConnection['database']] = true;

		$this->host     = $_GET['server']     = $arConnection['host'];
		$this->login    = $_GET['username']   = $arConnection['login'];
		$this->password = /*$_GET['password']=*/$arConnection['password'];
        $this->database = /*$_GET['db'] =     */$arConnection['database'];
	}

    /**
     * This method for authorization with empty password in credentials
     *
     * @param $login
     * @param $password
     * @return bool
     */
    public function login($login, $password) {
        return strcmp($login, $this->login) === 0 && strcmp($password, $this->password) === 0;
    }

    public function credentials()
	{
		return array($this->host, $this->login, $this->password);
	}

    public function database()
	{
		return $this->database;
	}
}
