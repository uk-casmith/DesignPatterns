<?php namespace UKCASmith\DesignPatterns\Behavioral\Interpreter\Expressions;

use UKCASmith\DesignPatterns\Behavioral\Interpreter\Contracts\Expression;
use UKCASmith\DesignPatterns\Behavioral\Interpreter\Contracts\CompoundExpression;

class Measurements implements CompoundExpression, Expression
{

    protected $expressions = [];

    /**
     * Add an expression.
     *
     * @param Expression $expression
     * @return $this
     */
    public function add(Expression $expression)
    {
        $this->expressions[] = $expression;

        return $this;
    }


    /**
     * Loop through expressions and return the value if found.
     *
     * @param $context
     * @return bool|object
     */
    public function solve(array $context)
    {
        $upperCaseContext = strtoupper(array_shift($context));

        $className = (substr($upperCaseContext, -1) === 'S') ? $upperCaseContext : $upperCaseContext . 'S';
        foreach($this->expressions as $object) {
            $reflect = new \ReflectionClass($object);

            if (strtoupper($reflect->getShortName()) !== $className) {
                continue;
            }

            if (count($context) == 0) {
                continue;
            }

            return $object->solve($context);
        }

        return false;
    }
}