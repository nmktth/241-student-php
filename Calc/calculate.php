<?php
header('Content-Type: application/json');

function validateBrackets($expression) {
    $stack = [];
    for ($i = 0; $i < strlen($expression); $i++) {
        $char = $expression[$i];
        if ($char === '(') {
            array_push($stack, $char);
        } elseif ($char === ')') {
            if (empty($stack)) {
                return false;
            }
            array_pop($stack);
        }
    }
    return empty($stack);
}

function calculate($expression) {
    $expression = str_replace(' ', '', $expression);

    if (!validateBrackets($expression)) {
        throw new Exception("Некорректное выражение: несбалансированные скобки");
    }

    return evaluate($expression);
}

function evaluate($expression) {
    while (preg_match('/\(([^()]+)\)/', $expression, $matches)) {
        $innerResult = evaluate($matches[1]);
        $expression = str_replace($matches[0], $innerResult, $expression);
    }

    $parts = explode('+', $expression);
    if (count($parts) > 1) {
        $result = 0;
        foreach ($parts as $part) {
            $result += evaluate($part);
        }
        return $result;
    }

    $parts = explode('-', $expression);
    if (count($parts) > 1) {
        $result = evaluate($parts[0]);
        for ($i = 1; $i < count($parts); $i++) {
            $result -= evaluate($parts[$i]);
        }
        return $result;
    }

    $parts = explode('*', $expression);
    if (count($parts) > 1) {
        $result = 1;
        foreach ($parts as $part) {
            $result *= evaluate($part);
        }
        return $result;
    }

    $parts = explode('/', $expression);
    if (count($parts) > 1) {
        $result = evaluate($parts[0]);
        for ($i = 1; $i < count($parts); $i++) {
            $result /= evaluate($parts[$i]);
        }
        return $result;
    }

    if (is_numeric($expression)) {
        return (float)$expression;
    }

    throw new Exception("Некорректное выражение: $expression");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expression = $_POST['expression'];
    try {
        $result = calculate($expression);
        echo json_encode(['result' => $result]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}