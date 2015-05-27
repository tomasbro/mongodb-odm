<?php

namespace Doctrine\ODM\MongoDB\Tests\Persisters;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Tests\BaseTest;

class IdStrategyForInheritanceTest extends BaseTest
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testDereferenceManyWithSetStrategyDoesNotUnsetFirst()
    {
        $childObj = new ChildClass();
        $childObj->name = 'ChildObject';
        $this->dm->persist($childObj);
        $this->dm->flush();

        $this->assertNotNull($childObj->id);
    }
}

/**
 * @ODM\Document 
 */
class ParentClass
{
    /** @ODM\Id(strategy="NONE") */
    public $id;

    /** @ODM\String */
    public $name;
}

/** @ODM\Document */
class ChildClass extends ParentClass
{
    /** @ODM\Id(strategy="AUTO") */
    public $id;

    /** @ODM\String */
    public $subject;
}