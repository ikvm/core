<?php

namespace OCA\DAV\CalDAV\Publishing\Xml;

use OCA\DAV\CalDAV\Publishing\PublishPlugin as Plugin;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Publisher implements XmlSerializable {

	/**
	 * @var string $publishUrl
	 */
	protected $publishUrl;

	/**
	 * @var boolean $isPublished
	 */
	protected $isPublished;

	/**
	 * @param string $publishUrl
	 * @param boolean $isPublished
	 */
	function __construct($publishUrl, $isPublished) {
		$this->publishUrl = $publishUrl;
		$this->isPublished = $isPublished;
	}

	/**
	 * @return string
	 */
	function getValue() {
		return $this->publishUrl;
	}

	/**
	 * The xmlSerialize metod is called during xml writing.
	 *
	 * Use the $writer argument to write its own xml serialization.
	 *
	 * An important note: do _not_ create a parent element. Any element
	 * implementing XmlSerializble should only ever write what's considered
	 * its 'inner xml'.
	 *
	 * The parent of the current element is responsible for writing a
	 * containing element.
	 *
	 * This allows serializers to be re-used for different element names.
	 *
	 * If you are opening new elements, you must also close them again.
	 *
	 * @param Writer $writer
	 * @return void
	 */
	function xmlSerialize(Writer $writer) {
		if (!$this->isPublished) {
			// for pre-publish-url
			$writer->write($this->publishUrl);
		} else {
			// for publish-url
			$writer->writeElement('{DAV:}href', $this->publishUrl);
		}
	}
}
