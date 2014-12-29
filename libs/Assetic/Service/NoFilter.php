<?php
namespace Warlord\Assetic\Service;

use Assetic\Filter\FilterInterface;
use Assetic\Asset\AssetInterface;

class NoFilter implements FilterInterface
{
	/**
	 * Filters an asset after it has been loaded.
	 *
	 * @param AssetInterface $asset An asset
	 */
	public function filterLoad(AssetInterface $asset)
	{

	}

	/**
	 * Filters an asset just before it's dumped.
	 *
	 * @param AssetInterface $asset An asset
	 */
	public function filterDump(AssetInterface $asset)
	{
		$asset->setContent($asset->getContent());
	}
}