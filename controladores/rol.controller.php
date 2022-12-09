<?php
class RolController{
    public static function getRole($field, $value) {
        $registro = RoleModel::showRole("roles",$field, $value);
        return $registro;
    }
}