<?php
/**
 *  Validation é a classe responsável pela validação de dados dentro do Spaghetti*,
 *  provendo métodos para vários tipos de validação, e também com a possibilidade
 *  de criação de alguns métodos personalizados.
 *
 *  @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 *  @copyright Copyright 2008-2009, Spaghetti* Framework (http://spaghettiphp.org/)
 *
 */

class Validation extends Object {
    /**
     *  Valida um valor alfanumérico (letras e números).
     *
     *  @param string $value Valor a ser validado
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function alphanumeric($value) {
        return preg_match("/^[\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]+$/mu", $value);
    }
    /**
     *  Valida um número ou comprimento de uma string que esteja entre dois outros
     *  valores especificados.
     *
     *  @param string $value Valor a ser validado
     *  @param integer $min Valor mínimo
     *  @param integer $max Valor máximo
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function between($value, $min, $max) {
        if(!is_numeric($value)):
            $value = strlen($value);
        endif;
        return $value >= $min && $value <= $max;
    }
    /**
      *  Valida se um valor é vazio.
      *
      *  @param string $value Valor a ser validado
      *  @return boolean Verdadeiro caso o valor seja válido
      */
    public static function blank($value) {
        return !preg_match("/[^\s]/", $value);
    }
    /**
     *  Valida um valor booleano (true, false, 0 ou 1).
     *
     *  @param string $value Valor a ser validado
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function boolean($value) {
        $boolean = array(0, 1, '0', '1', true, false);
        return in_array($value, $boolean, true);
    }
    public static function creditCard() {
        
    }
    /**
     *  Valida valores através de comparação.
     *
     *  @param string $value1 Primeiro valor a ser comparado
     *  @param string $operator Operador usado para comparar os valores
     *  @param string $value2 Segundo valor a ser comparado
     *  @return boolean Resultado da comparação
     */
    public static function comparison($value1, $operator, $value2) {
        switch($operator):
            case ">":
            case "greater":
                return $value1 > $value2;
            case "<":
            case "less":
                return $value1 < $value2;
            case ">=":
            case "greaterorequal":
                return $value1 >= $value2;
            case "<=":
            case "lessorequal":
                return $value1 <= $value2;
            case "==":
            case "equal":
                return $value1 == $value2;
            case "!=":
            case "notequal":
                return $value1 != $value2;
        endswitch;
        return false;
    }
    public static function date() {
        
    }
    /**
     *  Valida um número decimal.
     *
     *  @param string $value Valor a ser validado
     *  @param integer $places Número de casas decimais
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function decimal($value, $places = null) {
        if(is_null($places)):
            $regex = "/^[+-]?[\d]+\.[\d]+([eE][+-]?[\d]+)?$/";
        else:
            $regex = "/^[+-]?[\d]+\.[\d]{" . $places . "}$/";
        endif;
        return preg_match($regex, $value);
    }
    public static function email() {
        
    }
    /**
      *  Short description.
      *
      *  @param string $value
      *  @param string $compare
      *  @return boolean
      */
    public static function equal($value, $compare) {
        return $value === $compare;
    }
    public static function file() {
        // extension?
    }
    public static function ip() {
        
    }
    /**
     *  Valida se um valor tem um tamanho mínimo.
     *
     *  @param string $value Valor a ser validado
     *  @param integer $length Tamanho mínimo do valor
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function minLength($value, $length) {
        $valueLength = strlen($value);
        return $valueLength >= $length;
    }
    /**
     *  Valida se um valor tem um tamanho máximo.
     *
     *  @param string $value Valor a ser validado
     *  @param integer $length Tamanho máximo do valor
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function maxLength($value, $length) {
        $valueLength = strlen($value);
        return $valueLength <= $length;
    }
    public static function money() {
        
    }
    /**
     *  Valida um valor de múltipla escolha.
     *
     *  @param array $values Valores a serem validados
     *  @param array $list Lista contendo valores válidos
     *  @param integer $min Mínimo de ocorrências de escolhas
     *  @param integer $max Máximo de ocorrências de escolhas
     *  @return boolean Verdadeiro caso os valores sejam válidos
     */
    public static function multiple($values, $list, $min = null, $max = null) {
        $values = array_filter($values);
        if(empty($values)):
            return false;
        elseif(!is_null($min) && count($values) < $min):
            return false;
        elseif(!is_null($max) && count($values) > $max):
            return false;
        else:
            foreach(array_keys($values) as $value):
                if(!in_array($value, $list)):
                    return false;
                endif;
            endforeach;
        endif;
        return true;
    }
    /**
     *  Valida se um valor pertence a uma lista pré-definida.
     *
     *  @param string $value Valor a ser validado
     *  @param array $list Lista contendo valores válidos
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function inList($value, $list) {
        return in_array($value, $list);
    }
    /**
     *  Valida um valor numérico.
     *
     *  @param string $value Valor a ser validado
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function numeric($value) {
        return is_numeric($value);
    }
    /**
     *  Valida um valor não-vazio.
     *
     *  @param string $value Valor a ser validado
     *  @return boolean Verdadeiro caso o valor seja válido
     */
    public static function notEmpty($value) {
        return preg_match("/[^\s]+/m", $value);
    }
    public static function range() {
        
    }
    public static function time() {
        
    }
    public static function url() {
        
    }
}

?>