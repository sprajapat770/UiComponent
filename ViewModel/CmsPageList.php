<?php

namespace Suraj\UiComponent\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\UrlInterface;
use Magento\Cms\Api\Data\PageInterface;


class CmsPageList implements ArgumentInterface
{
	private $pageRepository;

	private $searchCriteriaBuilder;

	private $url;

	function __construct(
		PageRepositoryInterface $pageRepository,
		SearchCriteriaBuilder $searchCriteriaBuilder,
		UrlInterface $url
		)
	{
		$this->searchCriteriaBuilder = $searchCriteriaBuilder;
		$this->pageRepository = $pageRepository;
		$this->url = $url;
	}

	public function getItemsJson(){
		$result = [];
		foreach ($this->getItems() as $page) {
			$result[$page->getIdentifier()] = [ 
				"title" => $page->getTitle(),
				"url"   => $this->url->getUrl($page->getIdentifier())
			];

		}
		return json_encode($result);
	}

	public function getItems(){
		$searchCriteria = $this->searchCriteriaBuilder->create();
		$pageSearchResult = $this->pageRepository->getList($searchCriteria);
		return $pageSearchResult->getItems();
	}
}