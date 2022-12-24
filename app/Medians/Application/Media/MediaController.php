<?php

namespace Medians\Application\Media;

use Medians\Infrastructure as Repo;


class MediaController
{

	function __construct()
	{
		$this->repo = new Repo\Media\MediaRepository;
	}

	public function list()
	{

		return json_encode($this->repo->getList());

	}


	public function media($type = 'media', $request, $app, $twig)
	{
		return json_encode(['media'=> ($request->get('page') == 1) ? $this->repo->getList($type) : []]);

	}

	public function upload($request, $app, $twig)
	{
		foreach ($request->files as $key => $value) {
			$this->repo->upload($value);
		}
		return json_encode(['data'=> ['message'=>'Uploaded successfully']]);
		
	}

	public function delete($request, $app, $twig)
	{
	
	    $items = $request->get('items');

		foreach ($items as $key => $value) {
			$this->repo->upload($value);
		}
		return json_encode(['data'=> ['message'=>'Uploaded successfully']]);
		
	}



}
