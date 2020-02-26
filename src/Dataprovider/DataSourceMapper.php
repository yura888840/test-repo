<?php

namespace FeedReader\Dataprovider;

use FeedReader\Dataprovider\Assortment\DataSource\IMapper;

/**
 * Class DataSourceMapper
 * @package App\Dataprovider
 */
class DataSourceMapper
{
    /**
     * @var IMapper
     */
    private $mapper;

    /**
     * DataSourceDataMapper constructor.
     * @param IMapper $mapper
     */
    public function __construct(
        IMapper $mapper
    ) {
        $this->mapper = $mapper;
    }

    /**
     * @param array $input
     * @return array
     * @throws \Exception
     */
    public function map(array $input)
    {
        $mapping = $this->mapper->getMapping();
        $mappingFunctionSet = $this->mapper->getMappingFunctionSet();
        $mapped = [];

        foreach ($mapping as $targetField => $sourceField) {
            if (
                !in_array($sourceField, array_keys($input))
            ) {
                throw new \Exception(sprintf('Mandatory field - %s - in input feed is missing', $sourceField));
            }

            $funcResult = $this->runMapperFunction($input, $targetField, $mappingFunctionSet, $sourceField);

            $mapped[$targetField] = $funcResult ?? $input[$mapping[$targetField]];
        }

        return $mapped;
    }

    /**
     * @param array $input
     * @param $targetField
     * @param $mappingFunctionSet
     * @param $sourceFieldArgument
     * @return mixed
     */
    private function runMapperFunction(array $input, $targetField, $mappingFunctionSet, $sourceFieldArgument)
    {
        $resultOfFunctionExecution = null;

        if (array_key_exists($targetField, $mappingFunctionSet)) {

            $argument = array_key_exists($sourceFieldArgument, $input)
                ? $input[$sourceFieldArgument]
                : $sourceFieldArgument;

            $resultOfFunctionExecution = $mappingFunctionSet[$targetField] ($argument);
        }

        return $resultOfFunctionExecution;
    }
}
