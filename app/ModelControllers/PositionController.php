<?php

namespace App\ModelControllers;

use App\ModelControllers\Repositories\PositionRepository;

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

	/*** @return array */
	public function getNameList(): array
	{
		return $this->repo->getNameList();
	}
}