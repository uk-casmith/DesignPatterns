<?php namespace UKCASmith\DesignPatterns\Behavioral\Interpreter;

use UKCASmith\DesignPatterns\Behavioral\Interpreter\Contracts\Context;

class ConversionContext implements Context
{
    protected $conversionQuestion;
    protected $fromConversion;
    protected $toConversion;

    public function __construct($userInput)
    {
        $partsOfQuestion = explode(' ', trim($userInput));

        $this->fromConversion = $this->extractQuantityAndMeasurement($partsOfQuestion);
        $this->toConversion = $this->extractToMeasurement($partsOfQuestion);

    }

    /**
     * Get from conversion.
     *
     * @return array
     */
    public function getFrom()
    {
        return $this->fromConversion;
    }

    /**
     * Get to conversion.
     *
     * @return array
     */
    public function getTo()
    {
        return $this->toConversion;
    }

    /**
     * get the quantity and measurement.
     *
     * @param array $userInput
     * @return array
     */
    protected function extractQuantityAndMeasurement(array $userInput)
    {
        $quantity = $userInput[0];
        $measurement = $userInput[1];

        return [$quantity, $measurement];
    }

    protected function extractToMeasurement(array $userInput)
    {
        return [end($userInput)];
    }
}