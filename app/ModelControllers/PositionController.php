<?php

namespace App\ModelControllers;

use App\ModelControllers\Repositories\PositionRepository;
use App\Models\Position;

/**
 * Class PositionController
 * @package App\ModelControllers
 */
class PositionController
{

	/*** @var PositionRepository */
	public PositionRepository $repo;

	/**
	 * PositionController constructor.
	 * @param PositionRepository $repo
	 */
	public function __construct(PositionRepository $repo)
	{
		$this->repo = $repo;
	}

	/**
	 * @param int $id
	 * @return Position
	 */
	public function findById(int $id): Position
	{
		return $this->repo->findById($id);
	}

	/*** @return array */
	public function getNameList(): array
	{
		return $this->repo->getNameList();
	}
}