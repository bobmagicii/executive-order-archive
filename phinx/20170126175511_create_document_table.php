<?php

use Phinx\Migration\AbstractMigration;

class CreateDocumentTable
extends AbstractMigration {

	public function
	Up() {
	/*//
	operations to perform when upgrading the database with this migration.
	//*/

		$this->Execute("
CREATE TABLE `Documents` (
	`doc_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID - internal id',
	`doc_citation_id` VARCHAR(24) NULL COMMENT 'CitationID - seems to be a unique id for that document in our government.',
	`doc_document_id` VARCHAR(24) NULL COMMENT 'DocumentID - also seems to be a unique id, but different. because government is efficient.',
	`doc_document_type` VARCHAR(24) NULL COMMENT 'DocumentType - what type of presidential document this was.',
	`doc_signed_by` VARCHAR(24) NULL COMMENT 'SignedBy - the unique key to this president. i let the federal register define them.',
	`doc_date_published` DATE NULL COMMENT 'DatePublished - the day this document was made public.',
	`doc_date_signed` DATE NULL COMMENT 'DateSigned - the day this document was made signed.',
	`doc_title` VARCHAR(256) NULL COMMENT 'Title - name of document',
	`doc_json_urls` TEXT NULL COMMENT 'JsonDataURLs - json array of various urls found as a source of this document.',
	PRIMARY KEY (`doc_id`),
	UNIQUE INDEX `doc_citation_id` (`doc_citation_id`),
	UNIQUE INDEX `doc_document_id` (`doc_document_id`),
	INDEX `doc_date_published` (`doc_date_published`),
	INDEX `doc_date_signed` (`doc_date_signed`)
)
COMMENT='list of all the executive documents we have found.'
COLLATE='utf8_general_ci'
ENGINE=MyISAM;
		");

		return;
	}

	public function
	Down() {
	/*//
	operations to perform when downgrading the database with this migration.
	//*/

		$this->Execute("DROP TABLE IF EXISTS `Documents`;");

		return;
	}

}
