<?php declare(strict_types = 1);

namespace Adeira\Connector\Tests\Common\Infrastructure\DomainModel\Doctrine\Specification;

use Adeira\Connector\Common\Infrastructure\DomainModel\Doctrine\Specification\{
	ISpecification, OrX
};
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Tester\Assert;

require getenv('BOOTSTRAP');

/**
 * @testCase
 */
final class OrXTest extends \Adeira\Connector\Tests\TestCase
{

	use \Testbench\TCompiledContainer;

	public function testThatSpecificationWithOneChildIsEmpty()
	{
		$em = $this->getService(EntityManagerInterface::class);
		$match = (new OrX)->match(new QueryBuilder($em), 'dqlAlias');

		Assert::type(\Doctrine\ORM\Query\Expr\Orx::class, $match);
		Assert::same('', $match->__toString());
	}

	public function testThatSpecificationWithTwoChildsWorks()
	{
		$em = $this->getService(EntityManagerInterface::class);
		$match = (new OrX(
			$this->createSpecification('Part 1'),
			$this->createSpecification('Part 2')
		))->match(new QueryBuilder($em), 'dqlAlias');

		Assert::type(\Doctrine\ORM\Query\Expr\Orx::class, $match);
		Assert::same(['Part 1', 'Part 2'], $match->getParts());
	}

	public function testThatSpecificationWithMultipleChildsWorks()
	{
		$em = $this->getService(EntityManagerInterface::class);
		$match = (new OrX(
			$this->createSpecification('1'),
			new OrX(
				$this->createSpecification('2'),
				new OrX(
					$this->createSpecification('3'),
					$this->createSpecification('4')
				),
				$this->createSpecification('5')
			),
			$this->createSpecification('6')
		))->match(new QueryBuilder($em), 'dqlAlias');

		Assert::type(\Doctrine\ORM\Query\Expr\Orx::class, $match);
		Assert::same('1 OR (2 OR (3 OR 4) OR 5) OR 6', $match->__toString()); //may be fragile
	}

	private function createSpecification($part)
	{
		return new class ($part) implements ISpecification
		{

			private $part;

			public function __construct(string $part)
			{
				$this->part = $part;
			}

			public function match(\Doctrine\ORM\QueryBuilder $qb, string $dqlAlias): string
			{
				return $this->part;
			}

			public function isSatisfiedBy(string $candidate): bool
			{
				return TRUE;
			}

		};
	}

}

(new OrXTest)->run();
