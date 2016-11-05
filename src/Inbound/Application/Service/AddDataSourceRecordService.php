<?php declare(strict_types = 1);

namespace Adeira\Connector\Inbound\Application\Service;

use Adeira\Connector\Inbound\DomainModel\DataSource\DataSource;
use Adeira\Connector\Inbound\DomainModel\DataSource\DataSourceId;
use Adeira\Connector\Inbound\DomainModel\DataSource\IDataSourceRepository;
use Adeira\Connector\Inbound\DomainModel\DataSourceRecord\DataSourceRecord;
use Adeira\Connector\Inbound\DomainModel\DataSourceRecord\IDataSourceRecordRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Application services should depend on abstraction (interfaces) so we'll make our Application Service immune to
 * low-level Infrastructure changes. It's important to keep your Application Services setup out of the Infrastructure
 * boundary. Also those services should be registered in DIC.
 */
class AddDataSourceRecordService
{

	use \Nette\SmartObject;

	/**
	 * @var \Adeira\Connector\Inbound\DomainModel\DataSource\IDataSourceRepository
	 */
	private $dataSourceRepository;

	/**
	 * @var \Adeira\Connector\Inbound\DomainModel\DataSourceRecord\IDataSourceRecordRepository
	 */
	private $dataSourceRecordRepository;

	/**
	 * @var \Doctrine\ORM\EntityManagerInterface
	 */
	private $em;

	public function __construct(
		IDataSourceRepository $dataSourceRepository,
		IDataSourceRecordRepository $dataSourceRecordRepository,
		EntityManagerInterface $em
	) {
		$this->dataSourceRepository = $dataSourceRepository;
		$this->dataSourceRecordRepository = $dataSourceRecordRepository;
		$this->em = $em;
	}

	/**
	 * AddDataSourceRequest should be simple DTO filled by form in presenter.
	 */
	public function execute(AddDataSourceRecordRequest $request): bool
	{
		$dataSource = $this->findDataSourceOrFail(
			$request->dataSourceId()
		);

		$this->dataSourceRecordRepository->add(new DataSourceRecord(
			$this->dataSourceRecordRepository->nextIdentity(),
			$dataSource->id(),
			$request->data()
		));

		$this->em->flush();// FIXME: this is maybe weird?
		return TRUE; //TODO
	}

	private function findDataSourceOrFail(string $dataSourceId): DataSource
	{
		$dataSource = $this->dataSourceRepository->ofId(
			$dataSourceId = DataSourceId::createFromString($dataSourceId)
		);
		if ($dataSource === NULL) {
			throw new \Adeira\Connector\Inbound\Application\Exceptions\DataSourceDoesNotExistException($dataSourceId);
		}
		return $dataSource;
	}

}
