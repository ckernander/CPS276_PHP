<?php

class Calculator
{
    public function calc($operator, $num1 = null, $num2 = null)
    {

        $output = "";

        if (!isset($operator) || !isset($num1) || !isset($num2)) {
            return "Cannot preform operation. Missing argument(s).<br>";
        }

        if (!is_numeric($num1)) {
            return "Cannot preform operation. First value is not a number.<br>";
        }

        if (!is_numeric($num2)) {
            return "Cannot preform operation. Second value is not a number.<br>";
        }

        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                $output = "The Calculation is $num1 + $num2 The answer is $result<br>";
                break;
            case '-':
                $result = $num1 - $num2;
                $output = "The Calculation is $num1 - $num2 The answer is $result<br>";
                break;
            case '*':
                $result = $num1 * $num2;
                $output = "The Calculation is $num1 * $num2 The answer is $result<br>";
                break;
            case '/':
                if ($num2 == 0) {
                    $output = "The Calculation is $num1 / $num2 The answer is cannot divide by Zero.<br>";
                } else {
                    $result = $num1 / $num2;
                    $output = "The Calculation is $num1 / $num2 The answer is $result<br>";
                }
                break;
            default:
                $output = "Error: Invalid operator '$operator'. Please use an appropriate operator (+, -, *, /). <br>";
        }

        return $output;
    }
}
?>