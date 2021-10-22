<?php
require_once("BaseDAO.php");
require_once("User.php");

interface UserDAO extends BaseDAO{
   public function save(User $user);
   public function update(User $user);
}